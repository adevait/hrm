<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface as EducationInstitutionRepository;
use App\Modules\Settings\Http\Requests\EducationInstitutionRequest;
use Illuminate\Http\Request;
use Datatables;

class EducationInstitutionsController extends Controller
{
    private $educationInstitutionRepository;

    public function __construct(EducationInstitutionRepository $educationInstitutionRepository)
    {
        $this->educationInstitutionRepository = $educationInstitutionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::education_institutions.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->educationInstitutionRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($educationInstitution){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.education_institutions.destroy', $educationInstitution->id), 
                    'editUrl' => route('settings.education_institutions.edit', $educationInstitution->id)
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
        return view('settings::education_institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\EducationInstitutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationInstitutionRequest $request)
    {
        $educationInstitutionData = $this->educationInstitutionRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.education_institutions.store_success'));
        return redirect()->route('settings.education_institutions.edit', $educationInstitutionData->id);
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
        $educationInstitution = $this->educationInstitutionRepository->getById($id);
        return view('settings::education_institutions.edit', ['educationInstitution' => $educationInstitution, 'breadcrumb' => ['title' => $educationInstitution->name, 'id' => $educationInstitution->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EducationInstitutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EducationInstitutionRequest $request)
    {
        $educationInstitutionData = $this->educationInstitutionRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.education_institutions.update_success'));
        return redirect()->route('settings.education_institutions.edit', $educationInstitutionData->id);
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
        $this->educationInstitutionRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.education_institutions.delete_success'));
        return redirect()->route('settings.education_institutions.index');
    }
}