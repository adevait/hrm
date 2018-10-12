<?php

namespace App\Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface as LeaveTypeRepository;
use App\Modules\Leave\Http\Requests\EmployeeLeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;

class EmployeeLeaveController extends Controller
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
        $employees = $employeeRepository->pluckName();
        return view('leave::employee_leaves.index', compact('leaveTypes','employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->employeeLeaveRepository->getCollection([], ['id', 'user_id', 'leave_type_id', 'start_date', 'end_date', 'approved']))
            ->editColumn('user_id', function($leave) {
                return $leave->employee->first_name.' '.$leave->employee->last_name;
            })
            ->editColumn('leave_type_id', function($leave) {
                return $leave->leave_type->name;
            })
            ->addColumn('actions', function($leave){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('leave.employee_leaves.destroy', $leave->id), 
                    'editUrl' => route('leave.employee_leaves.edit', $leave->id),
                    'approveUrl' => !$leave->approved ? route('leave.employee_leaves.approve', $leave->id) : null
                ]);
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
        $employees = $employeeRepository->pluckName();
        return view('leave::employee_leaves.create', compact('leaveTypes', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeLeaveRequest $request)
    {
        $employeeLeaveData = $request->all();
        $employeeLeaveData['approved'] = 1;
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/leaves');
            $employeeLeaveData['attachment'] = $path;
        }
        $employeeLeaveData = $this->employeeLeaveRepository->create($employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        return redirect()->route('leave.employee_leaves.edit', $employeeLeaveData->id)->with('success', trans('app.leave.employee_leaves.store_success'));
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
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $employeeLeave = $this->employeeLeaveRepository->getById($id);
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $breadcrumb = ['title' => '#'.$employeeLeave->id, 'id' => $employeeLeave->id];
        $employees = $employeeRepository->pluckName();
        return view('leave::employee_leaves.edit', compact('employeeLeave', 'leaveTypes', 'breadcrumb','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EmployeeLeaveRequest $request)
    {
        $employeeLeaveData = $this->employeeLeaveRepository->getById($id);
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $employeeLeaveData = $request->all();
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/leaves');
            $employeeLeaveData['attachment'] = $path;
        }
        $employeeLeaveData = $this->employeeLeaveRepository->update($id, $employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $request->session()->flash('success', trans('app.leave.employee_leaves.update_success'));
        return redirect()->route('leave.employee_leaves.edit', $employeeLeaveData->id);
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
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $this->employeeLeaveRepository->delete($id);
        $request->session()->flash('success', trans('app.leave.employee_leaves.delete_success'));
        return redirect()->route('leave.employee_leaves.index');
    }

    /**
     * Approves an employee request for leave
     * 
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function approve($id, Request $request)
    {
        $employeeLeave = $this->employeeLeaveRepository->approveLeaveRequest($id);

        $this->sendLeaveRequest($id, [
            'employeeEmail' => $employeeLeave->employee->email,
            'dateFrom' => $employeeLeave->start_date,
            'dateTo'=> $employeeLeave->end_date,
            'requestId' => $employeeLeave->id,
        ]); 

        $leaveEndDate = Carbon::parse($employeeLeave->end_date)->addDay()->format('Y-m-d');

        if(env('ZAPIER_LEAVE_HOOK')) {
            $client = new Guzzle();
            $client->request('POST', env('ZAPIER_LEAVE_HOOK'), [
                'json' => [
                    'start_date' => $employeeLeave->start_date,
                    'end_date' => $leaveEndDate,
                    'name' => $employeeLeave->employee->first_name.' '.$employeeLeave->employee->last_name,
                ],
            ]);
        }

        $request->session()->flash('success', trans('app.leave.employee_leaves.approve_success'));
        return redirect()->route('leave.employee_leaves.index');
    }

    /**
     * Send leave approval email
     * @param  integer $id          
     * @param  array $emailDetails 
     */
    public function sendLeaveRequest($id, $emailDetails)
    {
        Mail::send('leave::employee_leaves.email_approve_leave', $emailDetails, function($message) use ($emailDetails)
        {
            $message->subject(trans('app.leave.employee_leaves.approve_email.subject'));
            $message->to($emailDetails['employeeEmail']);
        });
    }
}