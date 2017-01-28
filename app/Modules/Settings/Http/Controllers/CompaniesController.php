<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface as CompanyRepository;
use App\Modules\Settings\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Datatables;

class CompaniesController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::companies.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->companyRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($company){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.companies.destroy', $company->id), 
                    'editUrl' => route('settings.companies.edit', $company->id)
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
        return view('settings::companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $companyData = $this->companyRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.companies.store_success'));
        return redirect()->route('settings.companies.edit', $companyData->id);
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
        $company = $this->companyRepository->getById($id);
        return view('settings::companies.edit', ['company' => $company, 'breadcrumb' => ['title' => $company->name, 'id' => $company->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, CompanyRequest $request)
    {
        $companyData = $this->companyRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.companies.update_success'));
        return redirect()->route('settings.companies.edit', $companyData->id);
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
        $this->companyRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.companies.delete_success'));
        return redirect()->route('settings.companies.index');
    }
}