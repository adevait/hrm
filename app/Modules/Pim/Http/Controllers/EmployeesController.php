<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Http\Requests\EmployeeRequest;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Route;

class EmployeesController extends Controller
{
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pim::employees.index');
    }

    /**
     * Display a list of the birthdays.
     *
     * @return array
     */
    public function birthdays(Request $request)
    {
        $items = $this->employeeRepository->getBirthdays($request->get('date'));
        return $items;
    }

    /**
     * Return data for the resource list
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->employeeRepository->getCollection(
                [['key' => 'role', 'operator' => '=', 'value' => $this->employeeRepository->model::USER_ROLE_EMPLOYEE]],
                ['id', 'first_name', 'last_name', 'email']))
            ->addColumn('actions', function($employee){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.destroy', $employee->id),
                    'editUrl' => route('pim.employees.edit', $employee->id)
                ]);
            })
            ->make();
    }

    /**
     * Returns all employee details for using with select2
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSelectJson(Request $request)
    {
        return $this->employeeRepository->getSelect2Data($request->get('q'), $request->get('page'));
    }

    /**
     * Returns the selected employee details for using with select2
     * @param  integer $id the primary key of the selected employee
     * @return \Illuminate\Http\Response
     */
    public function getSelect2Selection($id)
    {
        return $this->employeeRepository->getSelect2Selection($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pim::employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Pim\Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employeeData = $request->all();
        $employeeData['role'] = $this->employeeRepository->model::USER_ROLE_EMPLOYEE;
        $employeeData = $this->employeeRepository->create($employeeData);
        $this->sendPassword($employeeData->id);

        $request->session()->flash('success', trans('app.pim.employees.store_success'));
        return redirect()->route('pim.employees.edit', $employeeData->id);
    }

    public function resendPassword($id, Request $request)
    {
        $this->sendPassword($id);
        $request->session()->flash('success', trans('app.pim.employees.pass_success'));
        return redirect()->back();
    }

    private function sendPassword($id)
    {
        $password = rand();
        $employeeData = $this->employeeRepository->update($id, ['password' => bcrypt($password)]);
        $data['email'] = [
            'name' => $employeeData->first_name,
            'system' => config('app.name'),
            'url' => url('/'),
            'email' =>  $employeeData->email,
            'password' => $password, 
            'change_pass_route' => url('password/reset'),
            'signature' => env('APP_NAME', 'HRM')
            ];
        Mail::send('emails.employee-login-password', $data, function($message) use ($employeeData)
        {
            $message->subject(trans('emails.employee_login.subject', ['name' => config('app.name')]));
            $message->to($employeeData['email']);
        });
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
    public function edit($id)
    {
        $employee = $this->employeeRepository->getById($id);
        if($employee->role == $this->employeeRepository->model::USER_ROLE_CANDIDATE) {
            return redirect()->route('pim.candidates.edit', $id);
        }
        return view('pim::employees.edit', ['employee' => $employee, 'breadcrumb' => ['title' => $employee->first_name.' '.$employee->last_name, 'id' => $employee->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EmployeeRequest $request)
    {
        $employeeData = $this->employeeRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.update_success'));
        return redirect()->route('pim.employees.edit', $employeeData->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->employeeRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.delete_success'));
        return redirect()->route('pim.employees.index');
    }
}
