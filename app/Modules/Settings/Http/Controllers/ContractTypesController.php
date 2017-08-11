<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface as ContractTypeRepository;
use App\Modules\Settings\Http\Requests\ContractTypeRequest;
use Illuminate\Http\Request;
use Datatables;

class ContractTypesController extends Controller
{
    private $contractTypeRepository;

    public function __construct(ContractTypeRepository $contractTypeRepository)
    {
        $this->contractTypeRepository = $contractTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::contract_types.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->contractTypeRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($contractType){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.contract_types.destroy', $contractType->id), 
                    'editUrl' => route('settings.contract_types.edit', $contractType->id)
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
        return view('settings::contract_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\ContractTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractTypeRequest $request)
    {
        $contractTypeData = $this->contractTypeRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.contract_types.store_success'));
        return redirect()->route('settings.contract_types.edit', $contractTypeData->id);
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
        $contractType = $this->contractTypeRepository->getById($id);
        return view('settings::contract_types.edit', ['contractType' => $contractType, 'breadcrumb' => ['title' => $contractType->name, 'id' => $contractType->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\ContractTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ContractTypeRequest $request)
    {
        $contractTypeData = $this->contractTypeRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.contract_types.update_success'));
        return redirect()->route('settings.contract_types.edit', $contractTypeData->id);
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
        $this->contractTypeRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.contract_types.delete_success'));
        return redirect()->route('settings.contract_types.index');
    }
}