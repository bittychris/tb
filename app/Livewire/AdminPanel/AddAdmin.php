<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Notifications\UserActionNotification;

class AddAdmin extends Component
{
    public $admin, $admin_id, $first_name, $last_name, $phone, $email, $roles, $role_id, $region_id, $regions;

    public $editMode = false;
    
    public function mount($admin_id = null)
    {
        $this->admin_id = $admin_id;

        if ($admin_id){
            $this->editMode = true;

            $this->admin = User::find($admin_id);

            $this->first_name = $this->admin->first_name;
            $this->last_name = $this->admin->last_name;
            $this->email = $this->admin->email;
            $this->phone = $this->admin->phone;
            $this->region_id = $this->admin->region_id;
            $this->role_id = $this->admin->role_id;
            
        }else{
            $this->editMode = false;
        }
    }

    protected function rules() {

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'region_id' => ['required'],
            'role_id' => ['required'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveAdmin() {
        $validatedData = $this->validate();

        if($this->editMode == false) {

            $checkAdminExists = User::where('email', $validatedData['email'])->exists();

            if ($checkAdminExists) {
                $this->dispatch('message_alert', 'The Email already exists.');

                // session()->flash('already_exist', 'The Email already exists.');

            } else {
            
                $admin = User::create([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'region_id' => $validatedData['region_id'],
                    'role_id' => $validatedData['role_id'],
                    'password' => bcrypt('Admin')

                ]);

                if ($admin) {
                    $role = Role::find($this->role_id);
                    $admin->assignRole($role->name);
                    $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();
                    $addedAdmin = User::latest()->first();

                    foreach($permissions as $permission) {
                        if($addedAdmin) {
                            DB::table('model_has_permissions')->insert([
                                'permission_id' => $permission->permission_id,
                                'model_id' => $addedAdmin->id,
                                'model_type' => 'App\Models\User'
                            ]);
    
                        }
                    }
                    
                    $this->clearForm();
                    
                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Added new Admin', 'admin'));

                    $this->dispatch('admin_success_alert', 'New Admin saved successfully');

                    // session()->flash('success', 'New Admin saved successfully');
                    // return redirect(route('admin.admins'));
                    
                } else {
                    $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                    // session()->flash('error', 'An error occurred. Try again later.');
                }

            }

        } else {
            
            $admin = User::where('id', $this->admin_id)->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'region_id' => $validatedData['region_id'],
                'role_id' => $validatedData['role_id']

            ]);
            
            // $admin->roles()->detach(); // This didn't work

            if ($admin) {
                // clear admin data in model_has_role table to enter new one
                $del_existing_role = DB::table('model_has_roles')->where('model_id', $this->admin_id)
                                    ->get();
                
                if($del_existing_role) {
                    DB::table('model_has_roles')->where('model_id', $this->admin_id)
                        ->delete();

                    DB::table('model_has_permissions')->where('model_id', $this->admin_id)
                        ->delete();

                    $role = Role::find($this->role_id);
                    $admin = User::find($this->admin_id);
                    $admin->assignRole($role->name);
                    $permissions = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

                    foreach($permissions as $permission) {
                        DB::table('model_has_permissions')->insert([
                            'permission_id' => $permission->permission_id,
                            'model_id' => $this->admin_id,
                            'model_type' => 'App\Models\User'
                        ]);
    
                    }

                    $this->clearForm();

                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Admin details', 'admin'));

                    $this->dispatch('admin_success_alert', 'Admin details updated successfully');

                    // session()->flash('success', 'Admin details updated successfully');
                    // return redirect(route('admin.admins'));
    
                } else {
                    $role = Role::find($this->role_id);
                    $admin = User::find($this->admin_id);
                    $admin->assignRole($role->name);

                    $this->clearForm();

                    $acting_user = User::find(auth()->user()->id);
                    $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated Admin details', 'admin'));

                    $this->dispatch('admin_success_alert', 'Admin details updated successfully');
                    
                    // session()->flash('success', 'Admin details updated successfully');
                    // return redirect(route('admin.admins'));

                }
               
            } else {
                $this->dispatch('failure_alert', 'An error occurred. Try again later.');

                // session()->flash('error', 'An error occurred. Try again later.');
            }
            
        }
        

    }

    public function clearForm() {
        $this->editMode = false;

        $this->admin = '';

        $this->admin_id = '';

        $this->reset(
            'first_name',
            'last_name',
            'phone',
            'email',
            'region_id',
            'role_id',
        );
    }

    public function render()
    {
        $this->roles = Role::where('name', 'Admin')->get();

        $this->regions = Region::orderBy('name', 'asc')->get();
        
        return view('livewire.admin-panel.add-admin', [
            'roles' => $this->roles,
            'regions' => $this->regions

        ]);
    }
}