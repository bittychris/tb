<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function show_login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));

             // User login successful
            //  $user = User::whereEmail($request['email'])->first();
            //  $roleData = role::find(Auth::user()->role_id);
            //  $role = $roleData->name; 
 
            //  if ($role == '') {
            //      return redirect()->intended(route('admin.dashboard'));
            //  }
            //  elseif ($role == 'Regional coordinator') {
            //      return redirect()->intended(route('admin.dashboard'));
            //  }
            //   elseif ($role == 'AMREF personnel') {
            //      return redirect()->intended(route('admin.dashboard'));
            //  }
            
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
