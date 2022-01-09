<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (auth($guard = 'customer')->check() && (auth($guard = 'customer')->user()->status == 0)) {
        //     Auth::guard('customer')->logout();

        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();

        //     return redirect()->route('user.login')->with('error', 'Tài khoản của bạn bị khóa vui lòng liên hệ quản trị viên');
        // }
        // if (auth($guard = 'customer')->check() && (auth($guard = 'customer')->user()->status == -1)) {
        //     Auth::guard('customer')->logout();

        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();

        //     return redirect()->route('user.login')->with('error', 'Tài khoản của bạn đã bị xoá. Muốn lấy lại thì ib');
        // }
        // return $next($request);

        if (auth($guard = 'customer')->check() && (auth($guard = 'customer')->user()->status == 0)) {
            Auth::guard('customer')->logout();

            // $request->session()->invalidate();
            // $request->session()->regenerateToken();
            // echo url()->previous();
            if(url()->previous() !== 'http://localhost:81/Group8_PhoneStore/customers'){
                return redirect()->route('user.login')->with('error', 'Tài khoản của bạn bị khóa vui lòng liên hệ quản trị viên');
            }
        }
        return $next($request);
    }
}
