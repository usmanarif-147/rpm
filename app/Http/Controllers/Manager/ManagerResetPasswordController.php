<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagerResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MANAGER_DASHBOARD;

    public function __construct()
    {
        $this->middleware('guest:manager');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('manager.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:5'],
        ];
    }

    protected function guard()
    {
        return Auth::guard('manager');
    }

    public function broker()
    {
        return Password::broker('managers');
    }
}
