<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeDocumentRepositoryInterface as EmployeeDocumentRepository;
use App\Modules\Settings\Repositories\Interfaces\DocumentTemplateRepositoryInterface as DocumentTemplateRepository;
use App\Modules\Pim\Http\Requests\EmployeeDocumentRequest;
use Illuminate\Http\Request;
use Datatables;
use PDF;

class EmployeeDocumentsController extends Controller
{
    private $employeeRepository;
    private $employeeDocumentRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeDocumentRepository $employeeDocumentRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeDocumentRepository = $employeeDocumentRepository;
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
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $accounts = $this->employeeDocumentRepository->getByMany(['user_id' => $employeeId])->get()->pluck('name','id');
        return view('pim::employee_documents.index', compact('breadcrumb', 'accounts'));
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable($employeeId)
    {
        return Datatables::of($this->employeeDocumentRepository->getQry([[
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], ['id', 'name', 'attachment', 'user_id']))
            ->editColumn('attachment', function($record) {
                return '<a href="'.route('storage',$record->attachment).'">'.route('storage',$record->attachment).'</a>';
            })
            ->addColumn('actions', function($record){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.documents.destroy', [$record->user_id, $record->id]), 
                    'editUrl' => route('pim.employees.documents.edit', [$record->user_id, $record->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    /**
     * Returns the form for generating document from template
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function generate($employeeId, DocumentTemplateRepository $documentTemplateRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $documents = $documentTemplateRepository->getByMany(['type' => $documentTemplateRepository->model::TYPE_PIM])->pluck('name','id');
        return view('pim::employee_documents.generate', compact('breadcrumb', 'documents'));
    }

    public function generateTemplateContent($employeeId, Request $request, DocumentTemplateRepository $documentTemplateRepository)
    {
        set_time_limit(-1);
        $bindings = template_toolbar();
        $document = $documentTemplateRepository->getById($request->get('document'));
        preg_match_all('/(%[a-z_]+\.[a-z_]+%)/', $document->template, $matches);
        $employee = $this->employeeRepository->getById($employeeId);
        foreach ($matches[1] as $key => $value) {
            $document->template = preg_replace('/'.$value.'/', $employee->{$bindings[trim($value, '%')]}, $document->template);
        }

        $pdf = PDF::loadView('pdf.default', ['content' => $document->template, 'details' => '']);
        return $pdf->download('document.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        return view('pim::employee_documents.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeeDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeDocumentRequest $request)
    {
        $documentData = $request->only(['name', 'description']) + ['user_id' => $employeeId];
        $attachment = $request->attachment->store('uploads/salaries');
        $documentData['attachment'] = $attachment;
        $documentData = $this->employeeDocumentRepository->create($documentData);
        $request->session()->flash('success', trans('app.pim.employees.documents.store_success'));
        return redirect()->route('pim.employees.documents.edit', [$employeeId, $documentData->id]);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $document = $this->employeeDocumentRepository->getById($id);
        $breadcrumb = [
            'parent_id' => $employee->id,
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role), 
            'id' => $document->id,
            'title' => $document->name
        ];
        return view('pim::employee_documents.edit', compact('document', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeeDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeDocumentRequest $request)
    {
        $documentData = $request->only(['name', 'description']) + ['user_id' => $employeeId];
        if($request->hasFile('attachment')) {
            $attachment = $request->attachment->store('uploads/salaries');
            $documentData['attachment'] = $attachment;
        }
        $documentData = $this->employeeDocumentRepository->update($id, $documentData);
        $request->session()->flash('success', trans('app.pim.employees.documents.update_success'));
        return redirect()->route('pim.employees.documents.edit', [$employeeId, $documentData->id]);
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
        $this->employeeDocumentRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.documents.delete_success'));
        return redirect()->route('pim.employees.documents.index', $employeeId);
    }
}