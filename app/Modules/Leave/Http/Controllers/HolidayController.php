<?php

namespace App\Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Repositories\Interfaces\HolidayRepositoryInterface as HolidayRepository;
use App\Modules\Leave\Http\Requests\HolidayRequest;
use Illuminate\Http\Request;
use Datatables;

class HolidayController extends Controller
{
    private $holidayRepository;

    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leave::holidays.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->holidayRepository->getQry([], ['id', 'name', 'date']))
            ->addColumn('actions', function($leave_type){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('leave.holidays.destroy', $leave_type->id), 
                    'editUrl' => route('leave.holidays.edit', $leave_type->id)
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
        return view('leave::holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\HolidayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayRequest $request)
    {
        $holidayData = $this->holidayRepository->create($request->all());
        $request->session()->flash('success', trans('app.leave.holidays.store_success'));
        return redirect()->route('leave.holidays.edit', $holidayData->id);
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
        $holiday = $this->holidayRepository->getById($id);
        return view('leave::holidays.edit', ['holiday' => $holiday, 'breadcrumb' => ['title' => $holiday->name, 'id' => $holiday->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Http\Requests\HolidayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, HolidayRequest $request)
    {
        $leaveTypeData = $this->holidayRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.leave.holidays.update_success'));
        return redirect()->route('leave.holidays.edit', $leaveTypeData->id);
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
        $this->holidayRepository->delete($id);
        $request->session()->flash('success', trans('app.leave.holidays.delete_success'));
        return redirect()->route('leave.holidays.index');
    }
}