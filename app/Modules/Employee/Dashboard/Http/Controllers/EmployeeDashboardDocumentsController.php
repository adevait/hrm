<?php

namespace App\Modules\Employee\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Repositories\Interfaces\DashboardDocumentsRepositoryInterface as DashboardDocumentsRepository;
use App\Modules\Dashboard\Http\Requests\DashboardDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Datatables;

class EmployeeDashboardDocumentsController extends Controller 
{
	private $dashboardDocumentsRepository;
	
	function __construct(DashboardDocumentsRepository $dashboardDocumentsRepository)
	{
		$this->dashboardDocumentsRepository = $dashboardDocumentsRepository;
	}

	public function index() 
	{
		return view('employee.dashboard_documents::index');
	}

	/**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->dashboardDocumentsRepository->getCollection([], ['id', 'name']))
           ->addColumn('actions', function($document){
                return view('includes._datatable_actions', [
                    'downloadUrl' => route('employee.dashboard_documents.download', $document->id)
                ]);
            })
            ->make();
    }

    public function download($id) 
    {
        $document = $this->dashboardDocumentsRepository->getById($id);
        return response()->download(base_path('storage/app/' . $document->attachment));
    }
}