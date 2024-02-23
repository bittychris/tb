<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        // $users = User::count();
        
        // if($users == 0) {
        //     return redirect()->route('admin_registration');
            
        // } else {
            return view('auth.login');
            
        // }
        
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {

            $user = User::where('email', $request->email)->first();

            if($user->status == true) {
                $request->session()->regenerate();

                return redirect()->intended(route('admin.dashboard'));

            } elseif($user->status == false) {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->back()->with('error', 'Your Account has been Deactivated, Contact System Administrator to Activate your Account');

            }
            
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
            
        }
        
    }

    public function userProfile() {
        // $email = auth()->user()->email;

        return view('admin_panel.user_profile');
    }

    public function changePassword() {
        // $email = auth()->user()->email;

        return view('auth.passwords.reset');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}