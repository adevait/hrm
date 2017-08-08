<?php

namespace App\Modules\Discipline\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseActionRepositoryInterface as DisciplinaryCaseActionRepository;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseRepositoryInterface as DisciplinaryCaseRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Discipline\Http\Requests\DisciplinaryCaseActionRequest;
use Illuminate\Http\Request;
use Datatables;

class DisciplinaryCasesActionsController extends Controller
{
    private $disciplinaryCaseActionRepository;

    public function __construct(DisciplinaryCaseActionRepository $disciplinaryCaseActionRepository)
    {
        $this->disciplinaryCaseActionRepository = $disciplinaryCaseActionRepository;
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
        return view('discipline::disciplinary_cases_actions.index', compact('employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->disciplinaryCaseActionRepository->getCollection([], ['id', 'name', 'description', 'disciplinary_case_id']))
            ->editColumn('disciplinary_case_id', function($disciplinary_case_action){
                return $disciplinary_case_action->disciplinaryCase->name;
            })
            ->addColumn('actions', function($disciplinary_case_action){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('discipline.disciplinary_cases_actions.destroy', $disciplinary_case_action->id), 
                    'editUrl' => route('discipline.disciplinary_cases_actions.edit', $disciplinary_case_action->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Pim\Http\Repositories\Interfaces\DisciplinaryCaseRepository $disciplinaryCaseRepository
     * @return \Illuminate\Http\Response
     */
    public function create(DisciplinaryCaseRepository $disciplinaryCaseRepository)
    {
        $disciplinary_cases = $disciplinaryCaseRepository->getAll()->pluck('name', 'id');
        return view('discipline::disciplinary_cases_actions.create', compact('disciplinary_cases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Discipline\Http\Requests\DisciplinaryCaseActionRequest  $request
     @param  \App\Modules\Pim\Http\Repositories\Interfaces\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplinaryCaseActionRequest $request, EmployeeRepository $employeeRepository)
    {
        $disciplinaryCaseData = $this->disciplinaryCaseActionRepository->create($request->all());
        $employee = $employeeRepository->getById($disciplinaryCaseData->user_id);
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.store_success'));
        return redirect()->route('discipline.disciplinary_cases_actions.edit', $disciplinaryCaseData->id);
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
    public function edit($id, EmployeeRepository $employeeRepository, DisciplinaryCaseRepository $disciplinaryCaseRepository)
    {
        $disciplinary_case_action = $this->disciplinaryCaseActionRepository->getById($id);
        $disciplinary_cases = $disciplinaryCaseRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->pluckName();
        $breadcrumb = ['title' => $disciplinary_case_action->name, 'id' => $disciplinary_case_action->id];
        return view('discipline::disciplinary_cases_actions.edit', compact('employees', 'disciplinary_case_action', 'disciplinary_cases', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Discipline\Http\Requests\DisciplinaryCaseActionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, DisciplinaryCaseActionRequest $request)
    {
        $disciplinaryCaseData = $this->disciplinaryCaseActionRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.update_success'));
        return redirect()->route('discipline.disciplinary_cases_actions.edit', $disciplinaryCaseData->id);
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
        $this->disciplinaryCaseActionRepository->delete($id);
        $request->session()->flash('success', trans('app.discipline.disciplinary_cases.delete_success'));
        return redirect()->route('discipline.disciplinary_cases_actions.index');
    }
}