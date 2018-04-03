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

    public function getMonthlySummary($filter = array(), $columns = [])
    {
        $response = $this->model->whereNull('deleted_at');

        foreach ($filter as $key => $value) {
            if($value['operator'] == 'between') {
                $response->whereBetween($value['key'], $value['value']);
            } else {
                $response->where($value['key'], $value['operator'], $value['value']);
            }
        }

        $response->groupBy('user_id');

        return $response->select(DB::raw('user_id, SUM(time) as t'));
    }

    public function getEmployeeReport($userId, $dateFrom, $dateTo, $group = 'task', $where = [])
    {
        switch ($group) {
            case 'client':
                $groupBy = 'projects.client_id';
                $select = [
                    'clients.name as client',
                    DB::raw('sum(time) as time'),
                    'projects.client_id',
                ];
                break;
            case 'project':
                $groupBy = 'time_logs.project_id';
                $select = [
                    'clients.name as client', 
                    'projects.name as project', 
                    DB::raw('sum(time) as time'), 
                    'projects.client_id', 
                    'time_logs.project_id',
                ];
                break;
            default:
                $groupBy = 'time_logs.id';
                $select = [
                    'clients.name as client', 
                    'projects.name as project', 
                    DB::raw('sum(time) as time'), 
                    'projects.client_id', 
                    'time_logs.project_id',
                    'time_logs.task_name',
                    'time_logs.task_description',
                    'time_logs.id as log_id',
                ];
                break;
        }
        $timeLog = TimeLog::join('projects', 'projects.id', '=', 'time_logs.project_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->where('user_id', $userId)
            ->whereNull('time_logs.deleted_at');
        if(!empty($where)) {
            $timeLog = $timeLog->where($where);
        }
        $timeLog = $timeLog->groupBy($groupBy)
            ->select($select)
            ->get();
        return $timeLog;
    }

    public function getTotalHours($userId, $dateFrom, $dateTo)
    {
        return TimeLog::join('projects', 'projects.id', '=', 'time_logs.project_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->where('user_id', $userId)
            ->whereNull('time_logs.deleted_at')
            ->sum('time');
    }
}
