<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\JobPositionRepositoryInterface as JobPositionRepository;
use App\Modules\Settings\Http\Requests\JobPositionRequest;
use Illuminate\Http\Request;
use Datatables;

class JobPositionsController extends Controller
{
    private $jobPositionRepository;

    public function __construct(JobPositionRepository $jobPositionRepository)
    {
        $this->jobPositionRepository = $jobPositionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings::job_positions.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->jobPositionRepository->getQry([], ['id', 'name', 'description']))
            ->addColumn('actions', function($jobPosition){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('settings.job_positions.destroy', $jobPosition->id), 
                    'editUrl' => route('settings.job_positions.edit', $jobPosition->id)
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
        return view('settings::job_positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\JobPositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobPositionRequest $request)
    {
        $jobPositionData = $request->all();
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/job_positions');
            $jobPositionData['attachment'] = $path;
        }
        $jobPositionData = $this->jobPositionRepository->create($jobPositionData);
        $request->session()->flash('success', trans('app.settings.job_positions.store_success'));
        return redirect()->route('settings.job_positions.edit', $jobPositionData->id);
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
        $jobPosition = $this->jobPositionRepository->getById($id);
        return view('settings::job_positions.edit', ['jobPosition' => $jobPosition, 'breadcrumb' => ['title' => $jobPosition->name, 'id' => $jobPosition->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\JobPositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, JobPositionRequest $request)
    {
        $jobPositionData = $request->all();
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/job_positions');
            $jobPositionData['attachment'] = $path;
        }
        $jobPositionData = $this->jobPositionRepository->update($id, $jobPositionData);
        $request->session()->flash('success', trans('app.settings.job_positions.update_success'));
        return redirect()->route('settings.job_positions.edit', $jobPositionData->id);
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
        $this->jobPositionRepository->delete($id);
        $request->session()->flash('success', trans('app.settings.job_positions.delete_success'));
        return redirect()->route('settings.job_positions.index');
    }
}