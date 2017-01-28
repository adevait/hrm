<?php

namespace App\Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface as LeaveTypeRepository;
use App\Modules\Leave\Http\Requests\LeaveTypeRequest;
use Illuminate\Http\Request;
use Datatables;

class LeaveTypeController extends Controller
{
    private $leaveTypeRepository;

    public function __construct(LeaveTypeRepository $leaveTypeRepository)
    {
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leave::leave_types.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->leaveTypeRepository->getQry([], ['id', 'name', 'available_days', 'start_date', 'end_date']))
            ->addColumn('actions', function($leave_type){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('leave.leave_types.destroy', $leave_type->id), 
                    'editUrl' => route('leave.leave_types.edit', $leave_type->id)
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
        return view('leave::leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\LeaveTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveTypeRequest $request)
    {
        $leaveTypeData = $this->leaveTypeRepository->create($request->all());
        $request->session()->flash('success', trans('app.leave.leave_types.store_success'));
        return redirect()->route('leave.leave_types.edit', $leaveTypeData->id);
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
        $leave_type = $this->leaveTypeRepository->getById($id);
        return view('leave::leave_types.edit', ['leave_type' => $leave_type, 'breadcrumb' => ['title' => $leave_type->name, 'id' => $leave_type->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Http\Requests\LeaveTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, LeaveTypeRequest $request)
    {
        $leaveTypeData = $this->leaveTypeRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.leave.leave_types.update_success'));
        return redirect()->route('leave.leave_types.edit', $leaveTypeData->id);
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
        $this->leaveTypeRepository->delete($id);
        $request->session()->flash('success', trans('app.leave.leave_types.delete_success'));
        return redirect()->route('leave.leave_types.index');
    }
}