<?php

namespace App\Modules\Time\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Time\Repositories\Interfaces\ProjectRepositoryInterface as ProjectRepository;
use App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface as ClientRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Time\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Datatables;

class ProjectsController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface  $clientRepository
     * @return \Illuminate\Http\Response
     */
    public function index(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->getAll()->pluck('name', 'id');
        return view('time::projects.index', compact('clients'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->projectRepository->getQry([], ['id', 'name', 'client_id']))
            ->editColumn('client_id', function($project) {
                return $project->client->name;
            })
            ->addColumn('actions', function($project){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('time.projects.destroy', $project->id), 
                    'editUrl' => route('time.projects.edit', $project->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface  $clientRepository
     * @param  \App\Modules\PIM\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(ClientRepository $clientRepository, EmployeeRepository $employeeRepository)
    {
        $clients = $clientRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        return view('time::projects.create', compact('clients', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $companyData = $this->projectRepository->create($request->all());
        $request->session()->flash('success', trans('app.time.projects.store_success'));
        return redirect()->route('time.projects.edit', $companyData->id);
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
     * @param  \App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface  $clientRepository
     * @param  \App\Modules\PIM\Repositories\Interfaces\EmployeeRepositoryInterface  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ClientRepository $clientRepository, EmployeeRepository $employeeRepository)
    {
        $project = $this->projectRepository->getById($id);
        $project->assignees = $project->assignees()->pluck('user_id')->toArray();
        $clients = $clientRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        $breadcrumb = ['title' => $project->name, 'id' => $project->id];
        return view('time::projects.edit', compact('project', 'clients', 'employees' , 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProjectRequest $request)
    {
        $clientData = $this->projectRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.time.projects.update_success'));
        return redirect()->route('time.projects.edit', $clientData->id);
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
        $this->projectRepository->delete($id);
        $request->session()->flash('success', trans('app.time.projects.delete_success'));
        return redirect()->route('time.projects.index');
    }
}