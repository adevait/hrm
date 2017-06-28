<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;

class ProfileController extends Controller
{
    /**
     * Show the profile config page.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return view('profile', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProfileRequest $request
     * @param  \App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, EmployeeRepository $employeeRepository)
    {
        $employeeData = $employeeRepository->update($request->user()->id, $request->all());
        
        $request->session()->flash('success', trans('app.profile.update_success'));
        return redirect()->route('profile.index');
    }
}
