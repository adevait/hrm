<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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

    public function login(Request $request)
    {
        $credentials = Input::only('email', 'password'); 
        if (!Auth::attempt($credentials)){
            return redirect()->back()->withMessage('Invalid credentials');
        }
        if (Auth::user()->role == User::USER_ROLE_EMPLOYEE) {
            return redirect()->to('/employee');
        }
        if (Auth::user()->role == User::USER_ROLE_ADMIN) {
            return redirect()->to('/admin');
        }

    }
}
