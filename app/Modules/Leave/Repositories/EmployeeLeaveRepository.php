<?php

namespace App\Modules\Leave\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Leave\Models\EmployeeLeave;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveStatusRepositoryInterface;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface;
use Carbon\Carbon;

class EmployeeLeaveRepository extends EloquentRepository implements EmployeeLeaveRepositoryInterface
{
    public function __construct(EmployeeLeave $model,
        EmployeeLeaveStatusRepositoryInterface $employeeLeaveStatusRepository,
        LeaveTypeRepositoryInterface $leaveTypeRepository)
    {
        $this->model = $model;
        $this->employeeLeaveStatusRepository = $employeeLeaveStatusRepository;
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    public function getCalendarItems($date = false)
    {
        if(!$date) {
            $date = Carbon::now();
        } else {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        }
        $items = $this->model
            ->whereRaw('(MONTH(start_date) = ? AND YEAR(start_date) = ?) OR (MONTH(end_date) = ? AND YEAR(end_date) = ?)', 
                [
                    $date->month, 
                    $date->year, 
                    $date->month, 
                    $date->year
            ])
            ->get();

        $events = [];
        foreach ($items as $key => $value) {
            $events[]= [
                'title' => $value->employee->first_name.' '.$value->employee->last_name,
                'start' => $value->start_date,
                'end' => $value->end_date
            ];
        }
        return $events;
    }

    // to do: get a whole employeeLeave object
    public function updateStatus($userId, $leaveTypeId, $startDate, $endDate)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $days = $endDate->diffInDays($startDate);
        $employeeLeaveStatus = $this->employeeLeaveStatusRepository->getByMany(['user_id' => $userId, 'leave_type_id' => $leaveTypeId])->first();
        if(!$employeeLeaveStatus) {
            $leaveType = $this->leaveTypeRepository->getById($leaveTypeId);
            $employeeLeaveStatus = $this->employeeLeaveStatusRepository->create(
                [
                    'user_id' => $userId,
                    'leave_type_id' => $leaveTypeId,
                    'total_available' => $leaveType->available_days,
                    'total_used' => $days
                ]
            );
            return $employeeLeaveStatus;
        } 
        $employeeLeaveStatus->total_used+=$days;
        $employeeLeaveStatus->save();
        return $employeeLeaveStatus;
    }

    public function deleteUsedDays($userId, $leaveTypeId, $startDate, $endDate)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $requestedDays = $endDate->diffInDays($startDate);
        $employeeLeaveStatus = $this->employeeLeaveStatusRepository->getByMany(['user_id' => $userId, 'leave_type_id' => $leaveTypeId])->first();
        $employeeLeaveStatus->total_used-=$requestedDays;
        $employeeLeaveStatus->save();
    }

    public function checkAvailableDays($userId, $leaveTypeId, $startDate, $endDate, $id = false)
    {
        // to do: difference in working days
        $leaveStatus = $this->employeeLeaveStatusRepository->getByMany(['user_id' => $userId, 'leave_type_id' => $leaveTypeId])->first();
        if($leaveStatus) {
            $days = $leaveStatus->total_available - $leaveStatus->total_used;
        } else {
            $days = $this->leaveTypeRepository->getById($leaveTypeId)->available_days;
        }
        if($id) {
            $old = $this->getById($id);
            $oldStartDate = Carbon::createFromFormat('Y-m-d', $old->start_date);
            $oldEndDate = Carbon::createFromFormat('Y-m-d', $old->end_date);
            $days += $oldEndDate->diffInDays($oldStartDate);
        }
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $requestedDays = $endDate->diffInDays($startDate);
        if($requestedDays <= $days) {
            return ['status' => true];
        }
        return ['status' => false, 'availableDays' => $days];
    }
}
