<?php

namespace App\Modules\Time\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Time\Models\TimeLog;
use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface;
use DB;
use Carbon\Carbon;

class TimeLogRepository extends EloquentRepository implements TimeLogRepositoryInterface
{
    public function __construct(TimeLog $model)
    {
        $this->model = $model;
    }

    public function weeklySummary()
    {
        return $this->model
            ->select(DB::raw('SUM(time) as time, user_id, project_id'))
            ->where('date', '>=', Carbon::now()->addWeeks(-1))
            ->where('date', '<=', Carbon::now())
            ->groupBy(DB::raw('user_id, project_id'))
            ->get();
    }

    public function getMonthlySummary($filter = array(), $columns = [], $other = false)
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

        $response->groupBy('user_id');
        $response->groupBy('project_id');

        return $response->select(DB::raw('project_id, user_id, SUM(time) as t'));
    }
}
