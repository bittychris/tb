<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserActionNotification;

class UserProfile extends Component
{
    use WithFileUploads;
    
    public $userDetails, $first_name, $last_name, $phone, $email, $image, $imageName;

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
            
            'image' => ['nullable', 'image', 'max:2048'],
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveUserDetails() {
        $validatedData = $this->validate();

        if (!empty($validatedData['image'])) {
            $path = 'storage/user_images/'.$this->userDetails->image;

            if (File::exists($path)) {
                File::delete($path);

                // Get the original file name
                $this->imageName = date('YmdHi').'-'.$this->first_name.'_'.$this->last_name.'.'.$validatedData['image']->getClientOriginalExtension();

                // Store the image in the storage folder with its original name
                $this->image->storeAs('user_images', $this->imageName, 'public');
                
            } else {
                // Get the original file name
                $this->imageName = date('YmdHi').'-'.$this->first_name.'_'.$this->last_name.'.'.$validatedData['image']->getClientOriginalExtension();

                // Store the image in the storage folder with its original name
                $this->image->storeAs('user_images', $this->imageName, 'public');
                
            }
            
        } else {
            $this->imageName = $this->userDetails->image;
        }
        
        $user = User::where('id', $this->userDetails->id)->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'image' => $this->imageName

        ]);

        if($user) {

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
            'image',
        );
    }
    
    public function render()
    {
        $this->userDetails = Auth::user();

        // if (!empty($this->image)) {
        //     $this->userDetails->image = $this->image;
            
        // }

        return view('livewire.admin-panel.user-profile', [
            'userDetails' => $this->userDetails
        ]);
    }
}