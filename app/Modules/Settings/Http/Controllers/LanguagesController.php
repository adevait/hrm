<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Modules\Settings\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;
use Datatables;

class LanguagesController extends Controller
{
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::languages.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->languageRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($language){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.languages.destroy', $language->id), 
                    'editUrl' => route('settings.languages.edit', $language->id)
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
        return view('settings::languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\LanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $languageData = $this->languageRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.languages.store_success'));
        return redirect()->route('settings.languages.edit', $languageData->id);
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
        $language = $this->languageRepository->getById($id);
        return view('settings::languages.edit', ['language' => $language, 'breadcrumb' => ['title' => $language->name, 'id' => $language->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\LanguageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, LanguageRequest $request)
    {
        $languageData = $this->languageRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.languages.update_success'));
        return redirect()->route('settings.languages.edit', $languageData->id);
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
        $this->languageRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.languages.delete_success'));
        return redirect()->route('settings.languages.index');
    }
}