<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;

class PersonasController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(Request $request)
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Pim\Http\Requests\CandidateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo \Breadcrumbs::render(\Route::currentRouteName(), @$breadcrumb);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        
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
        
    }
}
