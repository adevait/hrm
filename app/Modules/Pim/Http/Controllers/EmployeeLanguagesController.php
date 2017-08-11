<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeLanguageRepositoryInterface as EmployeeLanguageRepository;
use App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Modules\Pim\Http\Requests\EmployeeLanguageRequest;
use Illuminate\Http\Request;
use Datatables;

class EmployeeLanguagesController extends Controller
{
    private $employeeRepository;
    private $employeeLanguageRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeLanguageRepository $employeeLanguageRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeLanguageRepository = $employeeLanguageRepository;
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable($employeeId)
    {
        return Datatables::of($this->employeeLanguageRepository->getCollection([
            [
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], [
                'id', 
                'language_id', 
                'level', 
                'skill',
                'user_id'
            ]))
            ->editColumn('language_id', function($language) {
                return $language->language->name;
            })
            ->editColumn('level', function($language) {
                return get_language_level_name($language->level);
            })
            ->editColumn('skill', function($language) {
                return get_language_skill_name($language->skill);
            })
            ->addColumn('actions', function($language){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.qualifications.languages.destroy', [$language->user_id, $language->id]), 
                    'editUrl' => route('pim.employees.qualifications.languages.edit', [$language->user_id, $language->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface $languageRepository
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId, LanguageRepository $languageRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $languages = $languageRepository->pluck('name','id');
        return view('pim::employee_qualifications.languages.create', compact('breadcrumb', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeLanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeLanguageRequest $request)
    {
        $languageData = $request->all() + ['user_id' => $employeeId];
        $languageData = $this->employeeLanguageRepository->create($languageData);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.languages.store_success'));
        return redirect()->route('pim.employees.qualifications.languages.edit', [$employeeId, $languageData->id]);
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
     * @param  \App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface $languageRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id, LanguageRepository $languageRepository)
    {
        $language = $this->employeeLanguageRepository->getById($id);
        $employee = $this->employeeRepository->getById($employeeId);
        $languages = $languageRepository->pluck('name','id');
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role),
            'id' => $id,
            'title' => $language->language->name
        ];
        return view('pim::employee_qualifications.languages.edit', compact('breadcrumb', 'languages', 'language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeLanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeLanguageRequest $request)
    {
        $languageData = $this->employeeLanguageRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.qualifications.languages.update_success'));
        return redirect()->route('pim.employees.qualifications.languages.edit', [$employeeId, $languageData->id]);
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
        $this->employeeLanguageRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.languages.delete_success'));
        return redirect()->route('pim.employees.qualifications.index', $employeeId);
    }
}