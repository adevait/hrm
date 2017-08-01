<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Repositories\Interfaces\DashboardDocumentsRepositoryInterface as DashboardDocumentsRepository;
use App\Modules\Dashboard\Http\Requests\DashboardDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Datatables;

class DashboardDocumentsController extends Controller
{
	private $dashboardDocumentsRepository;
	
	function __construct(DashboardDocumentsRepository $dashboardDocumentsRepository)
	{
		$this->dashboardDocumentsRepository = $dashboardDocumentsRepository;
	}

	public function index() 
	{
		return view('dashboard::documents.index');
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
                    'editUrl' => route('dashboard.documents.edit', $document->id),
                    'deleteUrl' => route('dashboard.documents.destroy', $document->id),
                    'downloadUrl' => route('dashboard.documents.download', $document->id)
                ]);
            })
            ->make();
    }

    public function create() 
    {
    	return view('dashboard::documents.create');
    }

    public function edit($id) 
    {
        $document = $this->dashboardDocumentsRepository->getById($id);
        $breadcrumb = [
            'id' => $document->id,
            'title' => $document->name
        ];
        return view('dashboard::documents.edit', compact('document', 'breadcrumb'));
    }

    public function store(DashboardDocumentRequest $request) {
    	$documentData = $request->all();
        $attachment = $request->attachment->store('uploads/documents');
        $documentData['attachment'] = $attachment;
        $documentData = $this->dashboardDocumentsRepository->create($documentData);
        $request->session()->flash('success', trans('app.dashboard.documents.store_success'));
        
        return redirect()->route('dashboard.documents.edit', [$documentData->id]);
    }

    public function update($id, DashboardDocumentRequest $request)
    {
        $documentData = $request->all();
        if($request->hasFile('attachment')) {
            $attachment = $request->attachment->store('uploads/documents');
            $documentData['attachment'] = $attachment;
        }
        $documentData = $this->dashboardDocumentsRepository->update($id, $documentData);
        $request->session()->flash('success', trans('app.dashboard.documents.update_success'));

        return redirect()->route('dashboard.documents.edit', [$documentData->id]);
    }

    public function destroy($id, Request $request) {
		$this->dashboardDocumentsRepository->delete($id);
        $request->session()->flash('success', trans('app.dashboard.documents.delete_success'));

        return redirect()->route('dashboard.documents.index');
    }

    public function download($id)
    {
        $document = $this->dashboardDocumentsRepository->getById($id);
        return response()->download(base_path('storage/app/' . $document->attachment));
    }

}