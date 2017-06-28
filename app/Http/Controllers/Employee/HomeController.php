<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the profile config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome-employee');
    }
}
