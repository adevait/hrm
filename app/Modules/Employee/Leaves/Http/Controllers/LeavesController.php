<?php

namespace App\Modules\Employee\Leaves\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Http\Requests\EmployeeLeaveRequest;
use App\Modules\Leave\Repositories\EmployeeLeaveRepository;
use App\Modules\Leave\Repositories\LeaveTypeRepository;
use App\Modules\Pim\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
		$email = Auth::user()->email;
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->getByEmail($email)->pluck('first_name', 'id');
		
        return view('employee.leaves::index', compact('leaveTypes','employees'));
    }

    
}
