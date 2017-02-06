<?php

namespace App\Modules\Time\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Time\Repositories\Interfaces\ClientRepositoryInterface as ClientRepository;
use App\Modules\Time\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Datatables;

class ClientsController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('time::clients.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable()
    {
        return Datatables::of($this->clientRepository->getQry([], ['id', 'name']))
            ->addColumn('actions', function($client){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('time.clients.destroy', $client->id), 
                    'editUrl' => route('time.clients.edit', $client->id)
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
        return view('time::clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Settings\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $companyData = $this->clientRepository->create($request->all());
        $request->session()->flash('success', trans('app.time.clients.store_success'));
        return redirect()->route('time.clients.edit', $companyData->id);
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
        $client = $this->clientRepository->getById($id);
        return view('time::clients.edit', ['company' => $client, 'breadcrumb' => ['title' => $client->name, 'id' => $client->id]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ClientRequest $request)
    {
        $clientData = $this->clientRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.time.clients.update_success'));
        return redirect()->route('time.clients.edit', $clientData->id);
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
        $this->clientRepository->delete($id);
        $request->session()->flash('success', trans('app.time.clients.delete_success'));
        return redirect()->route('time.clients.index');
    }
}