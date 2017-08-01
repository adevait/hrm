<?php

namespace App\Modules\Employee\Leaves\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Employee\Leaves\Http\Requests\LeaveRequest;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface as LeaveTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Datatables;

class LeavesController extends Controller
{
    private $employeeLeaveRepository;

    public function __construct(EmployeeLeaveRepository $employeeLeaveRepository)
    {
        $this->employeeLeaveRepository = $employeeLeaveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function index(LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->getById(Auth::user()->id)->pluck('first_name', 'id');
        
        return view('employee.leaves::index', compact('leaveTypes','employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(EmployeeRepository $employeeRepository)
    {
        return Datatables::of($this->employeeLeaveRepository->getCollection([[
                'key' => 'user_id',
                'operator' => '=',
                'value' => Auth::user()->id
            ]], ['id', 'leave_type_id', 'start_date', 'end_date', 'approved']))
            ->editColumn('leave_type_id', function($leave) {
                return $leave->leave_type->name;
            })
            ->editColumn('approved', function($leave) {
                return $leave->approved ? trans('app.employee.leaves.approved') : trans('app.employee.leaves.pending');
            })
            ->addColumn('actions', function($leave){
                if($leave->approved) {
                    return view('includes._datatable_actions', [
                        'showUrl' => route('employee.leaves.show', $leave->id)
                    ]);
                } else {
                    return view('includes._datatable_actions', [
                        'deleteUrl' => route('employee.leaves.destroy', $leave->id), 
                        'editUrl' => route('employee.leaves.edit', $leave->id)
                    ]);
                }
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->getById(Auth::user()->id)->pluck('first_name', 'id');
        
        return view('employee.leaves::create', compact('leaveTypes', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        $employeeLeaveData = $request->all()+['user_id' => Auth::user()->id, 'approved' => 0];
        $employeeLeaveData = $this->employeeLeaveRepository->create($employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        return redirect()->route('employee.leaves.edit', $employeeLeaveData->id)->with('success', trans('app.employee.leaves.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = $this->employeeLeaveRepository->getById($id);
        $breadcrumb = ['title' => '#'.$leave->id, 'id' => $leave->id];
        return view('employee.leaves::show', compact('leave', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $employeeLeave = $this->employeeLeaveRepository->getById($id);
        checkValidity($employeeLeave->user_id);
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $breadcrumb = ['title' => '#'.$employeeLeave->id, 'id' => $employeeLeave->id];
        $employees = $employeeRepository->getById(Auth::user()->id)->pluck('first_name', 'id');
        return view('employee.leaves::edit', compact('employeeLeave', 'leaveTypes', 'breadcrumb','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, LeaveRequest $request)
    {
        $employeeLeaveData = $this->employeeLeaveRepository->getById($id);
        checkValidity($employeeLeaveData->user_id);
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $employeeLeaveData = $request->all();
        $employeeLeaveData = $this->employeeLeaveRepository->update($id, $employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $request->session()->flash('success', trans('app.employee.leaves.update_success'));
        return redirect()->route('employee.leaves.edit', $employeeLeaveData->id);
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
        $employeeLeaveData = $this->employeeLeaveRepository->getById($id);
        checkValidity($employeeLeaveData->user_id);
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $this->employeeLeaveRepository->delete($id);
        $request->session()->flash('success', trans('app.employee.leaves.delete_success'));
        return redirect()->route('employee.leaves.index');
    }
}