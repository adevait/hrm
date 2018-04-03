<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSalaryRepositoryInterface as EmployeeSalaryRepository;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface as SalaryComponentsRepository;
use App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface as SalariesSalaryComponentsRepository;
use App\Modules\Pim\Http\Requests\EmployeeSalaryRequest;
use Illuminate\Http\Request;
use Datatables;

class EmployeeSalaryController extends Controller
{
    private $employeeRepository;
    private $employeeSalaryRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeSalaryRepository $employeeSalaryRepository
        )
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
    public function index($employeeId)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $currentSalary = $this->employeeSalaryRepository->getCurrentSalary($employeeId);
        $currencies = $this->employeeSalaryRepository->getCurrencies();
        $types = $this->employeeSalaryRepository->getSalaryTypes();
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name
        ];
        return view('pim::employee_salaries.index', compact('breadcrumb', 'currentSalary', 'currencies', 'types'));
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable($employeeId)
    {
        return Datatables::of($this->employeeSalaryRepository->getQry([[
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], ['id', 'gross_total', 'nett_total', 'payment_date', 'user_id']))
            ->addColumn('actions', function($record){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.salaries.destroy', [$record->user_id, $record->id]), 
                    'editUrl' => route('pim.employees.salaries.edit', [$record->user_id, $record->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface $salaryComponentsRepository
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId, SalaryComponentsRepository $salaryComponentsRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name
        ];
        $salaryComponents = $salaryComponentsRepository->getAllOrdered('type', 'asc');
        return view('pim::employee_salaries.create', compact('breadcrumb','salaryComponents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeSalaryRequest  $request
     * @param  \App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface $salariesSalaryComponentsRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface $salaryComponentsRepository
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, 
        EmployeeSalaryRequest $request, 
        SalariesSalaryComponentsRepository $salariesSalaryComponentsRepository,
        SalaryComponentsRepository $salaryComponentsRepository)
    {
        // TODO: custom validation
        
        $salaryData = ['payment_date' => $request->input('payment_date'), 'user_id' => $employeeId];
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/salaries');
            $salaryData['attachment'] = $path;
        }
        $salaryData = $this->employeeSalaryRepository->create($salaryData);

        $components = $request->input('components');
        $total = $expense = 0;
        foreach ($components as $key => $value) {
            $component = $salaryComponentsRepository->getById($key);
            if($component->type == $salaryComponentsRepository->model::TYPE_EARNING) {
                $total+=$value;
            } else {
                $expense+=$value;
            }
            $salariesSalaryComponentsRepository->create([
                'value' => $value,
                'salary_component_id' => $key,
                'salary_id' => $salaryData->id 
            ]);
        }

        $this->employeeSalaryRepository->update($salaryData->id, ['gross_total' => $total, 'nett_total' => $total-$expense]);
         
        $request->session()->flash('success', trans('app.pim.employees.salaries.store_success'));
        return redirect()->route('pim.employees.salaries.edit', [$employeeId, $salaryData->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface $salariesSalaryComponentsRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface $salaryComponentsRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id,
        SalariesSalaryComponentsRepository $salariesSalaryComponentsRepository,
        SalaryComponentsRepository $salaryComponentsRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $salaryComponents = $salaryComponentsRepository->getAllOrdered('type', 'asc');
        $salary = $this->employeeSalaryRepository->getById($id);
        $salary->components = $salary->components->pluck('value', 'salary_component_id');
        $breadcrumb = [
            'parent_id' => $employee->id,
            'parent_title' => $employee->first_name.' '.$employee->last_name, 
            'id' => $salary->id,
            'title' => '#'.$salary->id
        ];
        return view('pim::employee_salaries.edit', compact('salary', 'breadcrumb', 'salaryComponents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeSalaryRequest  $request
     * @param  \App\Modules\Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface $salariesSalaryComponentsRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface $salaryComponentsRepository
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id,  
        EmployeeSalaryRequest $request, 
        SalariesSalaryComponentsRepository $salariesSalaryComponentsRepository,
        SalaryComponentsRepository $salaryComponentsRepository)
    {
        $components = $request->input('components');
        $total = $expense = 0;
        $salariesSalaryComponentsRepository->deleteByColumn('salary_id', $id);
        foreach ($components as $key => $value) {
            $component = $salaryComponentsRepository->getById($key);
            if($component->type == $salaryComponentsRepository->model::TYPE_EARNING) {
                $total+=$value;
            } else {
                $expense+=$value;
            }
            $salariesSalaryComponentsRepository->create([
                'value' => $value,
                'salary_component_id' => $key,
                'salary_id' => $id 
            ]);
        }
        $salaryData = ['gross_total' => $total, 'nett_total' => $total-$expense, 'payment_date' => $request->input('payment_date')];
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/salaries');
            $salaryData['attachment'] = $path;
        }
        $this->employeeSalaryRepository->update($id, $salaryData);
        $request->session()->flash('success', trans('app.pim.employees.salaries.update_success'));
        return redirect()->route('pim.employees.salaries.edit', [$employeeId, $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, $id, Request $request)
    {
        $this->employeeSalaryRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.salaries.delete_success'));
        return redirect()->route('pim.employees.salaries.index', $employeeId);
    }

    /**
     * Saves the current salary changes
     * 
     * @param  integer $employeeId
     * @param  Request $request
     * 
     * @return \Illuminate\Http\Response
     *
     * @todo Create a separate request handler
     */
    public function configSalary($employeeId, Request $request)
    {
        $salary = [
            'amount' => $request->amount,
            'type' => $request->type,
            'currency_id' => $request->currency_id,
            'bank_account' => $request->bank_account,
            'id_number' => $request->id_number,
            'user_id' => $employeeId,
        ];
        $this->employeeSalaryRepository->changeCurrentSalary($salary);
        return redirect()->route('pim.employees.salaries.index', $employeeId);
    }
}