<?php

namespace App\Modules\Leave\Repositories;

use App\Repositories\EloquentRepository;
use App\Modules\Leave\Models\Holiday;
use App\Modules\Leave\Repositories\Interfaces\HolidayRepositoryInterface;
use Carbon\Carbon;

class HolidayRepository extends EloquentRepository implements HolidayRepositoryInterface
{
    public function __construct(Holiday $model)
    {
        $this->model = $model;
    }

    public function getCalendarItems($date = false)
    {
        if(!$date) {
            $date = Carbon::now();
        } else {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        }
        $items = $this->model
            ->whereRaw('MONTH(date) = ? AND YEAR(date) = ?', [$date->month, $date->year])
            ->get();

        $events = [];
        foreach ($items as $key => $value) {
            $events[]= [
                'title' => trans('app.leave.holidays.name'),
                'start' => $value->date,
                'rendering' => 'background',
                'backgroundColor' => 'red'
            ];
        }
        return $events;
    }
}
