<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Http\Requests\CandidateRequest;
use App\Repositories\UserRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeTasksRepositoryInterface as EmployeeTasksRepository;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Modules\Pim\Http\Requests\EmployeeTaskRequest;

class EmployeeTasksController extends Controller
{
    private $employeeTasksRepository;
    private $userRepository;

    public function __construct(EmployeeTasksRepository $employeeTasksRepository, UserRepository $userRepository)
    {
        $this->employeeTasksRepository = $employeeTasksRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId)
    {
        $employee = $this->userRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        return view('pim::employee_tasks.index', compact('breadcrumb'));
    }

    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->employeeTasksRepository->getCollection([], 
                ['id', 'task_name', 'task_description', 'assigned_to', 'creator_id', 'due_date']))
            ->editColumn('assigned_to', function($task) {
                return $task->assignee->first_name.' '.$task->assignee->last_name;
            })
            ->editColumn('creator_id', function($task) {
                return $task->creator->first_name.' '.$task->creator->last_name;
            })
            ->addColumn('actions', function($task){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.tasks.destroy', ['employeeId' => Route::input('employeeId'), 'task' => $task->id]), 
                    'editUrl' => route('pim.employees.tasks.edit', ['employeeId' => Route::input('employeeId'), 'task' => $task->id])
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = $this->userRepository->pluckAdminNames();
        return view('pim::employee_tasks.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Pim\Http\Requests\EmployeeTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeTaskRequest $request)
    {
        $taskData = $request->all() + ['candidate_id' => Route::input('employeeId'), 'creator_id' => Auth::user()->id];
        $taskData = $this->employeeTasksRepository->create($taskData);
        $request->session()->flash('success', trans('app.pim.candidates.tasks.store_success'));
        return redirect()->route('pim.employees.tasks.edit', ['employeeId' => Route::input('employeeId'), 'task' => $taskData->id]);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id)
    {
        $task = $this->employeeTasksRepository->getById($id);
        $employee = $this->userRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'task_id' => $id
        ];
        $admins = $this->userRepository->pluckAdminNames();

        return view('pim::employee_tasks.edit', ['admins' => $admins, 'task' => $task, 'breadcrumb' => $breadcrumb]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeTaskRequest $request)
    {
        $task = $this->employeeTasksRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.candidates.tasks.update_success'));
        return redirect()->route('pim.employees.tasks.edit', ['employeeId' => $employeeId, 'task' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, $id, Request $request)
    {
        $this->employeeTasksRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.candidates.tasks.delete_success'));
        return redirect()->route('pim.employees.tasks.index', ['employeeId' => $employeeId, 'task' => $id]);
    }
}