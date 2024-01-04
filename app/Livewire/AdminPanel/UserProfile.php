<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserActionNotification;

class UserProfile extends Component
{
    public $userDetails, $first_name, $last_name, $phone, $email, $image;

    public $editMode = false;

    public $emailExists = false;

    public function prepareData() {
        $this->editMode = true;

        if($this->editMode == true) {
            $this->first_name = $this->userDetails->first_name;
            $this->last_name = $this->userDetails->last_name;
            $this->email = $this->userDetails->email;
            $this->phone = $this->userDetails->phone;
            $this->image = $this->userDetails->phone;

        }
        
    }

    protected function rules() {

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            // 'email' => 'required|email|unique:users,email,' . auth()->id(),
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->user()->id),
            ],
            // 'image' => ['nullable', 'image', 'max:2048'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveUserDetails() {
        $validatedData = $this->validate();

        // if (!empty($this->image)) {
        //     $path = 'storage/service_icons/'.$this->service->image;

        //     if (File::exists($path)) {
        //         File::delete($path);

        //         // Get the original file name
        //         $this->imageName = date('YmdHi').'-'.$this->name.'.'.$this->image->getClientOriginalExtension();

        //         // Store the image in the storage folder with its original name
        //         $this->image->storeAs('service_icons', $this->imageName, 'public');
                
        //     }
        // } else {
        //     $this->imageName = $this->service->image;
        // }
        
        $user = User::where('id', $this->userDetails->id)->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email']

        ]);

        if($user) {
            
            // Notification::create([
            //     'user_id' => auth()->user()->id,
            //     'message' => 'Updated Profile data.',
            // ]);

            $acting_user = User::find(auth()->user()->id);
            $acting_user->notify(new UserActionNotification(auth()->user(), 'Updated profile details'));

            $this->clearForm();
            redirect(route('user.profile'));
            session()->flash('success', 'Profile details updated successfully');

        }

    }

    public function clearForm() {
        $this->editMode = false;

        $this->reset(
            'first_name',
            'last_name',
            'phone',
            'email',
        );
    }
    
    public function render()
    {
        $this->userDetails = Auth::user();

        return view('livewire.admin-panel.user-profile', [
            'userDetails' => $this->userDetails
        ]);
    }
}