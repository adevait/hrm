<?php
namespace App\Modules\Employee\Time\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Time\Http\Requests\TimeLogRequest;
use App\Modules\Employee\Time\Http\Requests\EmployeeTimeLogRequest;
use App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface as ProjectRepository;
use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface as TimeLogRepository;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TimeController extends Controller {
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
    public function index(ProjectRepository $projectRepository, EmployeeRepository $employeeRepository)
    {
        $id = Auth::user()->id;
        $projects = $projectRepository->getByEmployee($id)->pluck('name', 'id');
        $employees = $employeeRepository->getById($id)->pluck('first_name', 'id');
        return view('employee.time::index', compact('projects', 'employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->timeLogRepository->getCollection([[
                'key' => 'user_id',
                'operator' => '=',
                'value' => Auth::user()->id
            ]], ['id', 'task_name', 'project_id', 'time', 'date']))
            ->editColumn('project_id', function($time) {
                return $time->project->name;
            })
            ->addColumn('actions', function($time){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('employee.time.destroy', $time->id), 
                    'editUrl' => route('employee.time.edit', $time->id)
                ]);
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
        $projects = $projectRepository->getByEmployee(Auth::user()->id)->pluck('name', 'id');
        return view('employee.time::create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Employee\Time\Http\Requests\EmployeeTimeLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeTimeLogRequest $request)
    {
        $companyData = $request->all()+['user_id' => Auth::user()->id];
        $companyData = $this->timeLogRepository->create($companyData);
        $request->session()->flash('success', trans('app.time.time_logs.store_success'));
        return redirect()->route('employee.time.edit', $companyData->id);
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
        checkValidity($timeLog->user_id);
        $projects = $projectRepository->getByEmployee(Auth::user()->id)->pluck('name', 'id');
        $breadcrumb = ['title' => $timeLog->task_name, 'id' => $timeLog->id];
        return view('employee.time::edit', compact('timeLog', 'projects', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Employee\Time\Http\Requests\TimeLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EmployeeTimeLogRequest $request)
    {
        $timeLogData = $this->timeLogRepository->getById($id);
        checkValidity($timeLogData->user_id);
        $timeLogData = $request->all();
        $timeLogData = $this->timeLogRepository->update($id, $timeLogData);
        $request->session()->flash('success', trans('app.time.time_logs.update_success'));
        return redirect()->route('employee.time.edit', $timeLogData->id);
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
        $timeLogData = $this->timeLogRepository->getById($id);
        checkValidity($timeLogData->user_id);
        $this->timeLogRepository->delete($id);
        $request->session()->flash('success', trans('app.time.time_logs.delete_success'));
        return redirect()->route('employee.time.index');
    }

    /**
     * Show the time log report for the given employee
     * @param  App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function report(
        Request $request,
        EmployeeRepository $employeeRepository,
        TimeLogRepository $timeLogRepository
    )
    {
        $userId = Auth::user()->id;
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
        return view('employee.time::report', compact('breadcrumb', 'clientLogs', 'totalHours', 'request'));
    }
}