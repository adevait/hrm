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

    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->get($columns);
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
}
