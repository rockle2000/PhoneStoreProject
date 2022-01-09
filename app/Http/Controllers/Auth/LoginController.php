<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    function showLoginForm()
    {
        return view('admin.login');
    }
    function logout(Request $request)
    {
        // Auth::logout();
        Auth::guard('web')->logout();
        return redirect('/login');
    }

    protected function authenticated()
    {
        if (Auth::user()->role == '1') //1 = Admin Login
        {
            return redirect('/dashboard');
        } elseif (Auth::user()->role == '0') // Normal or Default User Login
        {
            // return redirect('/home')->with('status', 'Access Denied! as you are not as Admin');
            return back()->with('status', 'Access Denied! as you are not as Admin');
        }
    }
}
