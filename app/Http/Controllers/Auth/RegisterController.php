<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show_admin_registration()
    {
        $regions = Region::orderBy('name', 'asc')->get();

        return view('auth.register', ['regions' => $regions]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'region_id' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $role = Role::latest()->first();

        $admin = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'region_id' => $data['region_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);;

        if($admin){
            $this->clearForm();

            $admin->assignRole($role->name);
            $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

            foreach($permissions as $permission) {
                DB::table('model_has_permissions')->insert([
                    'permission_id' => $permission->permission_id,
                    'model_id' => $admin->id,
                    'model_type' => 'App\Models\User'
                ]);

            }
            
        }

        session()->flash('success', 'Success!!! Login to continue');
                    
        return redirect()->route('login');
            
    }

    public function clearForm() {

        $this->reset(
            'first_name',
            'last_name',
            'phone',        
            'email',        
            'region_id',        
            'password',        
            'confirmed',        
        );
    }

}