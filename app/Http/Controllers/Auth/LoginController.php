<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\EmployeeRepository;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $employeeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->middleware('guest', ['except' => 'logout']);
    }

    // public function login(Request $request)
    // {
    //     $user = $this->employeeRepository->model->where('email', '=', $request->get('email'))->first();
    //     // dd($user['role']);
    //     if($user['role'] ==  User::USER_ROLE_EMPLOYEE) {
    //         return redirect('/employee');
    //     } 
    //     else if ($user['role'] ==  User::USER_ROLE_ADMIN) {
    //         return redirect('/');
    //     }
    // }
}
