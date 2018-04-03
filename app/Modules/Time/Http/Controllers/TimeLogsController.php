<?php

namespace App\Modules\Time\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface as TimeLogRepository;
use App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface as ProjectRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Time\Http\Requests\TimeLogRequest;
use App\Modules\Pim\Repositories\EmployeeSalaryRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Datatables;

class TimeLogsController extends Controller
{
    private $timeLogRepository;

    public function __construct(TimeLogRepository $timeLogRepository)
    {
        $this->timeLogRepository = $timeLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface  $projectRepository
     * @param  App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function index(
        ProjectRepository $projectRepository, 
        EmployeeRepository $employeeRepository)
    {
        $projects = $projectRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        return view('time::time_logs.index', compact('projects', 'employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(Request $request)
    {
        $filter = [];
        $order = [];
        if($request->date_from && $request->date_to) {
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_from.' 00:00:00');
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_to.' 23:59:59');
        } else {
            $start = Carbon::now()->subMonth();
            $end = Carbon::now();
        }  
        $filter[] = [
            'key' => 'date', 
            'operator' => 'between', 
            'value' => [$start, $end]
        ];
        return Datatables::of($this->timeLogRepository->getMonthlySummary(
                $filter, 
                ['user_id', 'time']
            ))
            ->editColumn('user_id', function($time_log) {
                $url = route('time.time_logs.employee_report', $time_log->user_id);
                return '<a class="employeeLog" href="'.$url.'" data-url="'.$url.'">'.$time_log->employee->first_name.' '.$time_log->employee->last_name.'</a>';
            })
            ->editColumn('time', function($time_log) {
                return format_hours($time_log->time);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface  $projectRepository
     * @param  App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(ProjectRepository $projectRepository, EmployeeRepository $employeeRepository)
    {
        $projects = $projectRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        return view('time::time_logs.create', compact('projects','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\TimeLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeLogRequest $request)
    {
        $companyData = $this->timeLogRepository->create($request->all());
        $request->session()->flash('success', trans('app.time.time_logs.store_success'));
        return redirect()->route('time.time_logs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface  $projectRepository
     * @param  App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ProjectRepository $projectRepository, EmployeeRepository $employeeRepository)
    {
        $timeLog = $this->timeLogRepository->getById($id);
        $projects = $projectRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        $breadcrumb = ['title' => $timeLog->task_name, 'id' => $timeLog->id];
        return view('time::time_logs.edit', compact('timeLog', 'projects', 'employees', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\TimeLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, TimeLogRequest $request)
    {
        $timeLogData = $this->timeLogRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.time.time_logs.update_success'));
        return redirect()->route('time.time_logs.edit', $timeLogData->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->timeLogRepository->delete($id);
        $request->session()->flash('success', trans('app.time.time_logs.delete_success'));
        return redirect()->route('time.time_logs.index');
    }

    /**
     * Show the time log report for the given employee
     * @param  integer $userId
     * @param  App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function employeeReport(
        $userId, 
        Request $request,
        EmployeeRepository $employeeRepository,
        TimeLogRepository $timeLogRepository
    )
    {
        if($request->date_start && $request->date_end) {
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_start.' 00:00:00');
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_end.' 23:59:59');
        } else {
            $start = Carbon::now()->subMonth();
            $end = Carbon::now();
        }  
        $employee = $employeeRepository->getById($userId);
        $breadcrumb = ['title' => $employee->first_name.' '.$employee->last_name, 'id' => $employee->id];
        $clientLogs = $timeLogRepository->getEmployeeReport($userId, $start, $end, 'client');
        $totalHours = 0;
        foreach ($clientLogs as $i => $clientLog) {
            $totalHours += $clientLog->time;
            $clientLogs[$i]->projectLogs = $timeLogRepository->getEmployeeReport($userId, $start, $end, 'project', ['projects.client_id' => $clientLog->client_id]);
            foreach ($clientLogs[$i]->projectLogs as $j => $projectLog) {
                $clientLogs[$i]->projectLogs[$j]->taskLogs = $timeLogRepository->getEmployeeReport($userId, $start, $end, 'task', ['time_logs.project_id' => $projectLog->project_id]);
            }
        }
        return view('time::time_logs.employee_report', compact('breadcrumb', 'clientLogs', 'totalHours', 'request'));
    }

    public function salaryReport(
        Request $request,
        EmployeeRepository $employeeRepository,
        EmployeeSalaryRepository $employeeSalaryRepository
    )
    {
        if($request->date_start && $request->date_end) {
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_start.' 00:00:00');
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_end.' 23:59:59');
        } else {
            $start = Carbon::now()->subMonth();
            $end = Carbon::now();
        }
        $employees = $employeeRepository->getAll();
        $report = [];
        foreach ($employees as $key => $employee) {
            $report[$employee->id] = [
                'salary' => $employeeSalaryRepository->getCurrentSalary($employee->id),
                'totalHours' => $this->timeLogRepository->getTotalHours($employee->id, $start, $end),
            ];
        }
        return view('time::time_logs.salary_report', compact('request', 'report', 'employees'));
    }
}