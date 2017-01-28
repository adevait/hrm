<?php

namespace App\Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use App\Modules\Leave\Repositories\Interfaces\HolidayRepositoryInterface as HolidayRepository;
use Illuminate\Http\Request;
use Datatables;

class CalendarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leave::calendar.index');
    }

    public function renderCalendar(Request $request, EmployeeLeaveRepository $employeeLeaveRepository, HolidayRepository $holidayRepository)
    {
        $leaveItems = $employeeLeaveRepository->getCalendarItems($request->get('date'));
        $holidayItems = $holidayRepository->getCalendarItems($request->get('date'));
        $items = array_merge($leaveItems, $holidayItems);
        return $items;
    }
}