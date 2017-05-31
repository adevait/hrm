<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Recruitment\Repositories\Interfaces\PersonaRepositoryInterface as PersonaRepository;
use App\Modules\Settings\Repositories\Interfaces\CustomFieldsRepositoryInterface as CustomFieldsRepository;
use Illuminate\Http\Request;
use App\Modules\Recruitment\Http\Requests\PersonaRequest;
use Datatables;

class PersonasController extends Controller
{
    private $personaRepository;

    public function __construct(PersonaRepository $personaRepository)
    {
        $this->personaRepository = $personaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recruitment::personas.index');
    }

    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(Request $request)
    {
        return Datatables::of($this->personaRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($company){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('recruitment.personas.destroy', $company->id), 
                    'editUrl' => route('recruitment.personas.edit', $company->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CustomFieldsRepository $customFieldsRepository)
    {
        $fields = $customFieldsRepository->getByType($customFieldsRepository->model::TYPE_PERSONA);
        return view('recruitment::personas.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Pim\Http\Requests\CandidateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request, CustomFieldsRepository $customFieldsRepository)
    {
        $allData = $request->all();
        $persona = ['name' => $allData['name']];
        $persona = $this->personaRepository->create($persona);
        foreach ($allData['fields'] as $key => $value) {
            $persona->fields()->create([
                'custom_field_id' => $key,
                'value' => $value
            ]);
        }
        $request->session()->flash('success', trans('app.recruitment.personas.store_success'));
        return redirect()->route('recruitment.personas.edit', $persona->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CustomFieldsRepository $customFieldsRepository)
    {
        $fields = $customFieldsRepository->getByType($customFieldsRepository->model::TYPE_PERSONA);
        $persona = $this->personaRepository->getById($id);
        $persona->fields = $persona->fields->pluck('value', 'custom_field_id');
        // dd($persona->fields);
        return view('recruitment::personas.edit', ['fields' => $fields, 'persona' => $persona, 'breadcrumb' => ['title' => $persona->name, 'id' => $persona->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, PersonaRequest $request)
    {
        $allData = $request->all();
        $persona = $this->personaRepository->update($id, ['name' => $allData['name']]);
        foreach ($allData['fields'] as $key => $value) {
            $persona->fields()->where('custom_field_id', $key)->update([
                'value' => $value
            ]);
        }
        $request->session()->flash('success', trans('app.recruitment.personas.update_success'));
        return redirect()->route('recruitment.personas.edit', $persona->id);
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
        $this->personaRepository->delete($id);
        $request->session()->flash('success', trans('app.recruitment.personas.delete_success'));
        return redirect()->route('recruitment.personas.index');
    }
}
