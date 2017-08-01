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
        $employee = Auth::user();
        $breadcrumb = [
            'parent_id' => $employee->id, 
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
        return Datatables::of($this->employeeSalaryRepository->getCollection([[
                'key' => 'user_id',
                'operator' => '=',
                'value' => Auth::user()->id
            ]], ['id', 'gross_total', 'nett_total', 'payment_date', 'attachment', 'user_id']))
            ->addColumn('actions', function($record){
                return view('includes._datatable_actions', [
                    'showUrl' => route('employee.salary.show', $record->id),
                    'downloadUrl' => ($record->attachment ? route('employee.salary.download', [$record->user_id, $record->id]) : '')
                ]);
            })
            ->removeColumn('attachment')
            ->removeColumn('user_id')
            ->make();
    }

    public function show($id, SalaryComponentsRepository $salaryComponentsRepository, SalariesSalaryComponentsRepository $salariesSalaryComponentsRepository)
    {
        $salary = $this->employeeSalaryRepository->getById($id);
        checkValidity($salary->user_id);
        $employee = Auth::user();
        $salaryComponents = $salaryComponentsRepository->getAllOrdered('type', 'asc');
        $components = [];
        for($i = 0; $i < count($salary->components); $i++) {
            $components[$i] = $salary->components[$i]->value;
        }
        $salary->components = $components;
        $breadcrumb = [
            'parent_id' => $employee->id,
            'parent_title' => $employee->first_name.' '.$employee->last_name, 
            'id' => $salary->id,
            'title' => '#'.$salary->id
        ];
        return view('employee.salary::show', compact('salary', 'breadcrumb', 'salaryComponents'));
    }

    public function downloadReport(Request $request)
    {
        $salary = $this->employeeSalaryRepository->getById($request->salary_id);
        checkValidity($salary->user_id);
        return response()->download(base_path('storage/app/' . $salary->attachment));
    }
}