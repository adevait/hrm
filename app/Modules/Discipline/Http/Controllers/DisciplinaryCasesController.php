<?php

namespace App\Modules\Discipline\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseRepositoryInterface as DisciplinaryCaseRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Discipline\Http\Requests\DisciplinaryCaseRequest;
use Illuminate\Http\Request;
use Datatables;

class DisciplinaryCasesController extends Controller
{
    private $disciplinaryCaseRepository;

    public function __construct(DisciplinaryCaseRepository $disciplinaryCaseRepository)
    {
        $this->disciplinaryCaseRepository = $disciplinaryCaseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Pim\Http\Repositories\Interfaces\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeRepository $employeeRepository)
    {
        $employees = $employeeRepository->pluckName();
        return view('discipline::disciplinary_cases.index', compact('employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->disciplinaryCaseRepository->getCollection([], ['id', 'user_id', 'name', 'description']))
            ->editColumn('user_id', function($disciplinary_case){
                return $disciplinary_case->employee->first_name.' '.$disciplinary_case->employee->last_name;
            })
            ->addColumn('actions', function($disciplinary_case){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('discipline.disciplinary_cases.destroy', $disciplinary_case->id), 
                    'editUrl' => route('discipline.disciplinary_cases.edit', $disciplinary_case->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Pim\Http\Repositories\Interfaces\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(EmployeeRepository $employeeRepository)
    {
        $employees = $employeeRepository->pluckName();
        return view('discipline::disciplinary_cases.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Discipline\Http\Requests\DisciplinaryCaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplinaryCaseRequest $request)
    {
        $disciplinaryCaseData = $this->disciplinaryCaseRepository->create($request->all());
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.store_success'));
        return redirect()->route('discipline.disciplinary_cases.edit', $disciplinaryCaseData->id);
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
     * @param  \App\Modules\Pim\Http\Repositories\Interfaces\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, EmployeeRepository $employeeRepository)
    {
        $disciplinary_case = $this->disciplinaryCaseRepository->getById($id);
        $employees = $employeeRepository->pluckName();
        $breadcrumb = ['title' => $disciplinary_case->name, 'id' => $disciplinary_case->id];
        return view('discipline::disciplinary_cases.edit', compact('employees', 'disciplinary_case', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Discipline\Http\Requests\DisciplinaryCaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, DisciplinaryCaseRequest $request)
    {
        $disciplinaryCaseData = $this->disciplinaryCaseRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.update_success'));
        return redirect()->route('discipline.disciplinary_cases.edit', $disciplinaryCaseData->id);
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
        $this->disciplinaryCaseRepository->delete($id);
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.delete_success'));
        return redirect()->route('discipline.disciplinary_cases.index');
    }
}