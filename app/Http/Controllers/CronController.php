<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    public function __construct()
    {

    }

    /**
     * This method MUST send emails reminders the the administrators of the 
     * birthdeys that are coming in two weeks from now.   
     * 
     * @return void
     */
    public function notifyBirthdeysToAdmin(EmployeeRepository $employeeRepository)
    {
        $date = new Carbon('+2 weeks');
        $employees = $employeeRepository->getEmployeesWithBirtheyOn($date);

        // No birthey in two weeks frmon now
        if (!count($employees)) {
            return;
        }

        $administrators = $employeeRepository->getAdminUsers();

        // No admin users to notify
        if (!count($administrators)) {
            return;
        }

        $data = [
            'employees' => $employees,
            'date' => $date,
        ];

        foreach ($administrators as $admin) {
            $data['admin'] = $admin;

            Mail::send('emails.birthdays.reminder', $data, function ($message) use ($admin) {
                $message->to($admin->email, $admin->email)->subject(trans('emails.birthdays.reminder.subject'));
            });
        }

        var_dump('Birthey reminders sent to ' . count($administrators) . ' administrator(s).');
    }
}
