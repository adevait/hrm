<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface as SalaryComponentsRepository;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface as ContractTypeRepository;
use App\Modules\Settings\Http\Requests\SalaryComponentRequest;
use Illuminate\Http\Request;
use Datatables;

class SalaryComponentsController extends Controller
{
    private $salaryComponentsRepository;

    public function __construct(SalaryComponentsRepository $salaryComponentsRepository)
    {
        $this->salaryComponentsRepository = $salaryComponentsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface  $contractTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function index(ContractTypeRepository $contractTypeRepository)
    {
        $contractTypes = $contractTypeRepository->getAll()->pluck('name','id');
        return view('settings::salary_components.index', compact('contractTypes'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->salaryComponentsRepository->getCollection([], ['id', 'name', 'contract_type_id', 'type', 'is_cost']))
            ->editColumn('contract_type_id', function($record) {
                return $record->contractType->name;
            })
            ->editColumn('type', function($record) {
                return get_salary_component_type_name($record->type);
            })
            ->editColumn('is_cost', function($record) {
                return $record->is_cost ? 'Yes' : 'No';
            })
            ->addColumn('actions', function($salaryComponent){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.salary_components.destroy', $salaryComponent->id), 
                    'editUrl' => route('settings.salary_components.edit', $salaryComponent->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface  $contractTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(ContractTypeRepository $contractTypeRepository)
    {
        $contractTypes = $contractTypeRepository->getAll()->pluck('name','id');
        return view('settings::salary_components.create', compact('contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\SalaryComponentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryComponentRequest $request)
    {
        $salaryComponentData = $this->salaryComponentsRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.salary_components.store_success'));
        return redirect()->route('settings.salary_components.edit', $salaryComponentData->id);
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
     * @param  \App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface  $contractTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ContractTypeRepository $contractTypeRepository)
    {
        $contractTypes = $contractTypeRepository->getAll()->pluck('name','id');
        $salaryComponent = $this->salaryComponentsRepository->getById($id);
        return view('settings::salary_components.edit', ['contractTypes' => $contractTypes, 'salaryComponent' => $salaryComponent, 'breadcrumb' => ['title' => $salaryComponent->name, 'id' => $salaryComponent->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\SalaryComponentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, SalaryComponentRequest $request)
    {
        $this->salaryComponentsRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.salary_components.update_success'));
        return redirect()->route('settings.salary_components.edit', $id);
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
        $this->salaryComponentsRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.salary_components.delete_success'));
        return redirect()->route('settings.salary_components.index');
    }
}