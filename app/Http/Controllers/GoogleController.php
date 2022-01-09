<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check Users Email If Already There
            $is_user = Customer::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = Customer::updateOrCreate([
                    'name' => $user->getName(),
                    'phone' => 0,
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId()),
                ]);
            }else{
                $saveUser = Customer::where('email',  $user->getEmail())->update([
                    'email' => $user->getEmail(),
                ]);
                $saveUser = Customer::where('email', $user->getEmail())->first();
            }


            // Auth::loginUsingId($saveUser->id,true);
            Auth::login($saveUser);

            return redirect('/');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
