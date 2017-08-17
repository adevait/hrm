<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\EmailTemplateRepositoryInterface as EmailTemplateRepository;
use App\Modules\Settings\Http\Requests\EmailTemplateRequest;
use Illuminate\Http\Request;
use Datatables;

class EmailTemplatesController extends Controller
{
    private $emailTemplateRepository;

    public function __construct(EmailTemplateRepository $emailTemplateRepository)
    {
        $this->emailTemplateRepository = $emailTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::email_templates.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->emailTemplateRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($document){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.email_templates.destroy', $document->id), 
                    'editUrl' => route('settings.email_templates.edit', $document->id)
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
        return view('settings::email_templates.create', compact('toolbar','toolbarStringified'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\DocumentTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateRequest $request)
    {
        $documentData = $this->emailTemplateRepository->create($request->all());
        $request->session()->flash('success', trans('app.settings.email_templates.store_success'));
        return redirect()->route('settings.email_templates.edit', $documentData->id);
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
        $emailTemplate = $this->emailTemplateRepository->getById($id);
        $breadcrumb = ['title' => $emailTemplate->name, 'id' => $emailTemplate->id];
        return view('settings::email_templates.edit', compact('toolbar', 'toolbarStringified', 'documentTemplate', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EmailTemplateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EmailTemplateRequest $request)
    {
        $documentData = $this->emailTemplateRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.settings.email_templates.update_success'));
        return redirect()->route('settings.email_templates.edit', $documentData->id);
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
        $this->emailTemplateRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.email_templates.delete_success'));
        return redirect()->route('settings.email_templates.index');
    }
}