<?php

namespace App\Modules\Employee\Salary\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSalaryRepositoryInterface as EmployeeSalaryRepository;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface as SalaryComponentsRepository;
use App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface as SalariesSalaryComponentsRepository;
use App\Modules\Pim\Http\Requests\EmployeeSalaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;

class SalaryController extends Controller
{
    private $employeeRepository;
    private $employeeSalaryRepository;

    public function __construct(EmployeeRepository $employeeRepository, EmployeeSalaryRepository $employeeSalaryRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeSalaryRepository = $employeeSalaryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeId = Auth::user()->id;
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name
        ];
        return view('employee.salary::index', compact('breadcrumb'));
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        $employeeId = Auth::user()->id;
        return Datatables::of($this->employeeSalaryRepository->getQry([[
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], ['id', 'gross_total', 'nett_total', 'payment_date', 'user_id']))
            ->addColumn('actions', function($record){
                return view('includes._datatable_actions', [
                    'showUrl' => route('employee.salary.show', $record->id),
                    'downloadUrl' => route('employee.salary.download', [$record->user_id, $record->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    public function show($id, SalaryComponentsRepository $salaryComponentsRepository, SalariesSalaryComponentsRepository $salariesSalaryComponentsRepository)
    {
        $employee = Auth::user();
        $salaryList = $this->employeeSalaryRepository->getById($id);
        // $salaryId = $salaryList->first()->id;
        // dd($salaryId);
        // $salaryComponentList = $this->salariesSalaryComponentsRepository->findBy('salary_component_id', )
        $breadcrumb = ['title' => $employee->first_name.' '.$employee->last_name, 'id' => $employee->id];
        return view('employee.salary::show', compact('salaryList', 'breadcrumb'));
    }

    public function downloadReport(Request $request)
    {
        dd($request->all());
    }
}