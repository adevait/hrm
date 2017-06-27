<?php

namespace App\Http\Controllers\Admin;

use App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface as TimeLogRepository;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the profile config page.
     *
     * @param  App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface $timeLogRepository
     * @return \Illuminate\Http\Response
     */
    public function index(TimeLogRepository $timeLogRepository)
    {
        $weekly_summary = $timeLogRepository->weeklySummary();
        return view('welcome', compact('weekly_summary'));
    }

     /**
     * Show the profile config page.
     *
     * @param  App\Modules\Time\Repositories\Interfaces\TimeLogRepositoryInterface $timeLogRepository
     * @return \Illuminate\Http\Response
     */
    public function indexEmployee(TimeLogRepository $timeLogRepository)
    {
        $weekly_summary = $timeLogRepository->weeklySummary();
        return view('welcome-employee', compact('weekly_summary'));
    }
}
