<?php

namespace App\Modules\Time\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface as TimeLogRepository;
use App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface as ProjectRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Time\Http\Requests\TimeLogRequest;
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
        return Datatables::of($this->timeLogRepository->getCollection(
                $filter, 
                ['id', 'task_name', 'project_id', 'user_id', 'time', 'date'],
                ['order' => ['date', 'desc']]
            ))
            ->editColumn('project_id', function($time_log) {
                return $time_log->project->name;
            })
            ->editColumn('user_id', function($time_log) {
                return $time_log->employee->first_name.' '.$time_log->employee->last_name;
            })
            ->addColumn('actions', function($time_log){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('time.time_logs.destroy', $time_log->id), 
                    'editUrl' => route('time.time_logs.edit', $time_log->id)
                ]);
            })
            ->make();
    }

    public function getMonthlyDatatable(Request $request)
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
                ['project_id', 'user_id', 'time']
            ))
            ->editColumn('project_id', function($time_log) {
                return $time_log->project->name;
            })
            ->editColumn('user_id', function($time_log) {
                return $time_log->employee->first_name.' '.$time_log->employee->last_name;
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
}