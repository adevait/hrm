<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\DocumentTemplateRepositoryInterface as DocumentTemplateRepository;
use App\Modules\Settings\Http\Requests\DocumentTemplateRequest;
use Illuminate\Http\Request;
use Datatables;

class DocumentTemplatesController extends Controller
{
    private $documentTemplateRepository;

    public function __construct(DocumentTemplateRepository $documentTemplateRepository)
    {
        $this->documentTemplateRepository = $documentTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::document_templates.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->documentTemplateRepository->getQry([], ['id', 'name', 'type']))
            ->editColumn('type', function($document){
                return get_document_template_type($document->type);
            })
            ->addColumn('actions', function($document){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.document_templates.destroy', $document->id), 
                    'editUrl' => route('settings.document_templates.edit', $document->id)
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
        $toolbar = array_keys(template_toolbar());
        $toolbarStringified = implode(' | ', $toolbar);
        $toolbar = json_encode($toolbar);
        return view('settings::document_templates.create', compact('toolbar','toolbarStringified'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\DocumentTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTemplateRequest $request)
    {
        $documentData = $this->documentTemplateRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.document_templates.store_success'));
        return redirect()->route('settings.document_templates.edit', $documentData->id);
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
        $toolbar = array_keys(template_toolbar());
        $toolbarStringified = implode(' | ', $toolbar);
        $toolbar = json_encode($toolbar);
        $documentTemplate = $this->documentTemplateRepository->getById($id);
        $breadcrumb = ['title' => $documentTemplate->name, 'id' => $documentTemplate->id];
        return view('settings::document_templates.edit', compact('toolbar', 'toolbarStringified', 'documentTemplate', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\JobPositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, DocumentTemplateRequest $request)
    {
        $documentData = $this->documentTemplateRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.document_templates.update_success'));
        return redirect()->route('settings.document_templates.edit', $documentData->id);
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
        $this->documentTemplateRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.document_templates.delete_success'));
        return redirect()->route('settings.document_templates.index');
    }
}