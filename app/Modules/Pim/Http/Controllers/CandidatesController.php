<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\CandidateRepositoryInterface as CandidateRepository;
use App\Modules\Pim\Http\Requests\CandidateRequest;
use Illuminate\Http\Request;
use Datatables;

class CandidatesController extends Controller
{
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pim::candidates.index');
    }

    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->candidateRepository->getCollection(
                [['key' => 'role', 'operator' => '=', 'value' => $this->candidateRepository->model::USER_ROLE_CANDIDATE]], 
                ['id', 'first_name', 'last_name', 'email']))
            ->addColumn('actions', function($employee){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.candidates.destroy', $employee->id), 
                    'editUrl' => route('pim.candidates.edit', $employee->id)
                ]);
            })
            ->make();
    }

    /**
     * Marks a candidate as featured for easier access
     * 
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function makeFeatured($id, Request $request)
    {
        $candidate = $this->candidateRepository->getById($id);
        $featured = !$candidate->featured;
        $candidate->featured = $featured;
        $candidate->save();
        if($request->ajax()){
            return ['isFeatured' => (int)$featured];
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pim::candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Pim\Http\Requests\CandidateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        $employeeData = $request->all();
        $employeeData['role'] = $this->candidateRepository->model::USER_ROLE_CANDIDATE;
        $employeeData = $this->candidateRepository->create($employeeData);
        $request->session()->flash('success', trans('app.pim.candidates.store_success'));
        return redirect()->route('pim.candidates.edit', $employeeData->id);
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
        $employee = $this->candidateRepository->getById($id);
        if($employee->role == $this->candidateRepository->model::USER_ROLE_EMPLOYEE) {
            return redirect()->route('pim.employees.edit', $id);
        }
        return view('pim::candidates.edit', ['employee' => $employee, 'breadcrumb' => ['title' => $employee->first_name.' '.$employee->last_name, 'id' => $employee->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\CandidateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, CandidateRequest $request)
    {
        $employeeData = $this->candidateRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.candidates.update_success'));
        return redirect()->route('pim.candidates.edit', $employeeData->id);
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
        $this->candidateRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.candidates.delete_success'));
        return redirect()->route('pim.candidates.index');
    }
}