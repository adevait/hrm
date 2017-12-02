<?php

namespace App\Repositories;

use DB;

/**
 * Class EloquentRepository
 *
 */
class EloquentRepository
{
    /**
     * The model the repository should interact with.
     *
     * @var Illuminate\Database\Eloquent\Model  $model
     */
    protected $model;

    /**
     * An amount of paginated results for fetch queries by this repository.
     *
     * @var integer
     */
    protected $paginateCount;

    /**
     * Set if create / update methods should add created_by / updated_by fields
     *
     * @var boolean
     */
    protected $addCreatorAndUpdater = true;

    /**
     * Array of attributes that can be returned with the magic __get method
     * @var array
     */
    protected $allowedAttributes = [];

    /**
     * Called when the repository should construct itself.
     *
     * @param Eloquent $model
     */
    public function __construct(Eloquent $model)
    {
        $this->model = $model;
    }

    /**
     * Check if an item exists on a model.
     *
     * @param  string  $key
     * @param  string  $value
     * @param  string  $operator
     * @return boolean
     */
    public function has($key, $value, $operator = '=')
    {
        $result = $this->model->where($key, $operator, $value)->first();

        return isset($result);
    }

    /**
     * Retrieve an item by its identifier.
     *
     * @param integer $id
     * @param bool $withTrashed
     *
     * @return array
     */
    public function getById($id, $withTrashed = false)
    {
        $model = ($withTrashed ? $this->model->withTrashed() : $this->model);

        return $model->findOrFail($id);
    }

    /**
     * Retrieves a set of data by multiple identifiers.
     *
     * @param array $ids
     *
     * @return Model
     */
    public function getByIds(array $ids)
    {
        // Remove any blank ids.
        $ids = array_filter($ids);

        return $this->fetch($this->model->whereRaw(DB::raw('id IN (' . join(',', $ids) . ')')));
    }

    /**
     * Retrieves an item by many attributes.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function getByMany(array $attributes)
    {
        $statement = $this->model;

        // Iterate through each of the provided attributes
        // and chain on a where statement for each field
        // and value. (TODO: Add operator support)
        foreach ($attributes as $field => $value) {
            $statement = $statement->where($field, '=', $value);
        }

        return $statement;
    }

    /**
     * Retrieve all items from the model.
     *
     * @return void
     */
    public function getAll()
    {
        return $this->fetch($this->model);
    }

    /**
     * Retrieves all items from the model in a specified order.
     *
     * @param string $field
     * @param string $order
     *
     * @return Model
     */
    public function getAllOrderedWithDate($field, $order)
    {
        return $this->fetch($this->model->where('date', '>', date('Y-m-d H:i:s'))->orderBy($field, $order));
    }

    /**
     * Retrieves all items from the model in a specified order.
     *
     * @param string $field
     * @param string $order
     *
     * @return Model
     */
    public function getAllOrdered($field, $order)
    {
        return $this->fetch($this->model->orderBy($field, $order));
    }

    /**
     * Fetches items from the repository
     *
     * @param Illuminate\Database\Query\Builder $query
     *
     * @return Illuminate\Support\Collection
     */
    protected function fetch($query)
    {
        // If a paginate counter has been applied to this class,
        // we will fetch the results paginated. Otherwise,
        // we will retrieve the results with a 'get()'.
        if (isset($this->paginationCount)) {
            return $query->paginate($this->paginationCount);
        }

        return $query->get();
    }

    /**
     * Creates a new entry in the model.
     *
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $relations = [];
        foreach ($data as $key => $value) {
            if (is_array($value) && method_exists($this->model, $key)) {
                $relations[$key] = $value;

                unset($data[$key]);
            }
        }

        $instance = $this->model->create($data);

        // reload model - this hac need to force refreshing primary key
        // when primary key is not increment and it will be 0 without reloading model
        // TODO: make it better
        if (array_key_exists($instance->getKeyName(), $data)) {
            $instance = $this->getById($data[$instance->getKeyName()]);
        }

        // add relation data
        foreach ($relations as $relationName => $relationData) {
            $instance->$relationName()->sync($relationData);
        }

        return $instance;
    }

    /**
     * Updates an existing model.
     *
     * @param  int  $id
     * @param  array  $data
     * 
     * @return Model
     */
    public function update($id, $data)
    {
        // load instance
        $instance = $this->model->where($this->model->getKeyName(), '=', $id)->first();

        // collect relation data into separate array
        $relations = [];
        foreach ($data as $key => $value) {
            if (is_array($value) && method_exists($this->model, $key)) {
                $relations[$key] = $value;
                unset($data[$key]);
            }
        }

        // update model
        $instance->update($data);
        
        // update relation data
        foreach ($relations as $relationName => $relationData) {
            $instance->$relationName()->sync($relationData);
        }

        return $instance;
    }

    /**
     * Removes an entry from the model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->where($this->model->getKeyName(), '=', $id)->delete();
    }

    public function deleteByColumn($key, $value)
    {
        return $this->model->where($key, '=', $value)->delete();
    }

    /**
     * Restores a soft deleted entry.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function restore($id)
    {
        return $this->model->where($this->model->getKeyName(), '=', $id)->restore();
    }

    /**
     * Paginate.
     *
     * @param $items
     *
     * @return mixed
     */
    public function paginate($items)
    {
        if (is_array($items)) {
            $items = Illuminate\Database\Eloquent\Collection::make($items);
        }

        $currentPage = Input::get('page') ? Input::get('page') - 1 : 0 ;
        $pagedData = $items->slice($currentPage * $this->paginationCount, $this->paginationCount)->all();

        return Paginator::make($pagedData, count($items), $this->paginationCount);
    }

    /**
     * Convert oject to Array
     * 
     * @param  $object
     * 
     * @return array
     */
    public function fromObjToArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * Eloquent List method
     * 
     * @param  [type] $id    [description]
     * @param  [type] $value [description]
     * 
     * @return [type]        [description]
     */
    public function lists($value, $id)
    {
        return $this->model->lists($value, $id);
    }

    /**
     * Eloquent Pluck method
     * 
     * @param  [type] $id    [description]
     * @param  [type] $value [description]
     * 
     * @return [type]        [description]
     */
    public function pluck($value, $id = false)
    {
        return $this->model->pluck($value, $id);
    }

    /**
     * Datatables query. 
     * 
     * @param  [type] $filter [description]
     * 
     * @return [type]         [description]
     */
    public function getQry($filter = array(), $columns = [])
    {
        $response = DB::table($this->model->getTable())->whereNull('deleted_at');
        foreach ($filter as $key => $value) {
            $response->where($value['key'], $value['operator'], $value['value']);
        }
        if($columns) {
            $response->select($columns);
        }
        return $response;
    }

    /**
     * Datatables collection. 
     * 
     * @param  [type] $filter [description]
     * 
     * @return [type]         [description]
     */
    public function getCollection($filter = array(), $columns = [], $other = false)
    {
        $response = $this->model->whereNull('deleted_at');

        foreach ($filter as $key => $value) {
            if($value['operator'] == 'between') {
                $response->whereBetween($value['key'], $value['value']);
            } else {
                $response->where($value['key'], $value['operator'], $value['value']);
            }
        }

        if($other) {
            if(isset($other['order'])) {
                $response->orderBy($other['order'][0], $other['order'][1]);
            }
        }

        if ($columns) {
            return $response->select($columns);
        }

        $response = $response->get();

        return $response;
    }

    /**
     * Magic __get method for returning the instance of the private attributes
     * 
     * @param  string $attr The name of the attribute that should be accessed
     * 
     * @return mixed       The corresponding class attribute if allowed, false otherwise
     */
    public function __get($attr)
    {
        if (in_array($attr, $this->allowedAttributes)) {
            return $this->$attr;
        }
        return false;
    }
}
