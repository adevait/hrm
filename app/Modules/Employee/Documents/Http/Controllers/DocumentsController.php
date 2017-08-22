<?php

namespace App\Modules\Employee\Documents\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeDocumentRepositoryInterface as EmployeeDocumentRepository;
use App\Modules\Settings\Repositories\Interfaces\DocumentTemplateRepositoryInterface as DocumentTemplateRepository;
use App\Modules\Pim\Http\Requests\EmployeeDocumentRequest;
use Illuminate\Http\Request;
use Datatables;
use PDF;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    private $employeeRepository;
    private $employeeDocumentRepository;

    public function __construct(EmployeeRepository $employeeRepository,EmployeeDocumentRepository $employeeDocumentRepository)
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
    public function index()
    {
        $employee = Auth::user();
        $breadcrumb = [
            'parent_id' => $employee->id, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $accounts = $this->employeeDocumentRepository->getByMany(['user_id' => $employee->id])->get()->pluck('name','id');
        return view('employee.documents::index', compact('breadcrumb', 'accounts'));
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->employeeDocumentRepository->getCollection([[
                'key' => 'user_id',
                'operator' => '=',
                'value' => Auth::user()->id
            ]], ['id', 'name', 'attachment', 'user_id', 'description']))
            ->editColumn('attachment', function($record) {
                return '<a href="'.route('storage',$record->attachment).'">'.route('storage',$record->attachment).'</a>';
            })
            ->addColumn('actions', function($record){
                return view('includes._datatable_actions', [
                    'downloadUrl' => route('employee.documents.download', [$record->user_id, $record->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    public function downloadDocument(Request $request) 
    {
        $document = $this->employeeDocumentRepository->getById($request->document_id);
        checkValidity($document->user_id);
        return response()->download(base_path('storage/app/' . $document->attachment));
    }

}