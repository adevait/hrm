<?php

namespace App\Modules\Time\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Time\Models\Project;
use App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository extends EloquentRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function getQry($filter = array(), $columns = [])
    {
        $response = $this->model->whereNull('deleted_at');

        foreach ($filter as $key => $value) {
            $response->where($value['key'], $value['operator'], $value['value']);
        }

        if ($columns) {
            return $response->select($columns);
        }

        $response = $response->get();

        return $response;
    }

    /**
     * Returns all projects for the given employee
     * 
     * @param  integer $id the id of the employee
     * 
     * @return Collection
     */
    public function getByEmployee($id)
    {
        $projects = $this->model::whereHas('assignees', function($query) use ($id) {
            $query->where('user_id', $id);
        });

        return $projects;
    }
}
