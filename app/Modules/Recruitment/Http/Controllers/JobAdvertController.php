<?php

namespace App\Modules\Recruitment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Recruitment\Repositories\Interfaces\JobAdvertRepositoryInterface as JobAdvertRepository;
use Datatables;
use App\Modules\Recruitment\Http\Requests\JobAdvertRequest;

class JobAdvertController extends Controller
{
    private $jobAdvertRepository;

    public function __construct(JobAdvertRepository $jobAdvertRepository)
    {
        $this->jobAdvertRepository = $jobAdvertRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recruitment::job_advert.index');
    }
    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
    */
    public function getDatatable()
    {
        return Datatables::of($this->jobAdvertRepository->getQry(
                [],
                ['id', 'title', 'description']))->addColumn('actions', function($JobAdvert){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('recruitment.job_advert.destroy', $JobAdvert->id ), 
                    'editUrl' => route('recruitment.job_advert.edit', $JobAdvert->id)
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
        return view('recruitment::job_advert.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobAdvertRequest $request)
    {
        $jobData = $request->all();
        $jobData = $this->jobAdvertRepository->create($jobData);
        $request->session()->flash('success', trans('app.recruitment.job_advert.store_success'));
        return redirect()->route('recruitment.job_advert.edit', $jobData->id);    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
