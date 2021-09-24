<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
use Session;
use Log;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'user_type' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($credentials['user_type'] == 'Root User'){
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
    
                return redirect()->intended('home');
            }
        }else if($credentials['user_type'] == 'Doctor'){
            // $user = Doctor::where('email', $credentials['email']);
            if (Auth::guard('doctor')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                Log::info('Authentication Attempt was Successful');
    
                return redirect()->intended(RouteServiceProvider::DOCTOR);
            }
        }else if($credentials['user_type'] == 'Pharmacist'){
            if (Auth::guard('pharmacist')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
    
                return redirect()->intended('home');
            }
        }else{
            if (Auth::guard('nurse')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                Log::info('Authentication Attempt was Successful');

                return redirect()->intended('home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

}
