<?php

namespace App\Modules\Employee\Discipline\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Discipline\Repositories\Interfaces\DisciplinaryCaseRepositoryInterface as DisciplinaryCaseRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Discipline\Http\Requests\DisciplinaryCaseRequest;
use Illuminate\Http\Request;
use Datatables;

class DisciplineController extends Controller
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
        return view('employee.discipline::index', compact('employees'));
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
                    'showUrl' => route('employee.discipline.show', $disciplinary_case->id)
                ]);
            })
            ->make();
    }


    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disciplinaryCase = $this->disciplinaryCaseRepository->getById($id);
        checkValidity($disciplinaryCase->user_id);
        $breadcrumb = ['title' => $disciplinaryCase->employee->first_name.' '.$disciplinaryCase->employee->last_name, 'id' => $disciplinaryCase->id];
        return view('employee.discipline::show', compact('disciplinaryCase', 'breadcrumb'));
    }

}