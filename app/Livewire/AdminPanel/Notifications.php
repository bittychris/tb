<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;

class Notifications extends Component
{    
    public $notificationCounter, $notifications;

    public function notificationCount() {
        if(auth()->user()->role->name == 'Admin') {
            return $this->notificationCounter = auth()->user()->unreadNotifications->count();
            
        } else {
            return $this->notificationCounter = '';
            
        }
    }

    public function markAllRead()
    {

        DB::table('notifications')->where('read_at', null)->update([
            'read_at' => now()
        ]);

        $this->notifications = auth()->user()->unreadNotifications;
        
    }

    public function markRead($notification_id) {

        $user = User::find(auth()->user()->id);
 
        DB::table('notifications')->where('id', $notification_id)->update([
            'read_at' => now()
        ]);
        
        $this->notifications = auth()->user()->unreadNotifications;

    }
    
    public function render()
    {
            
        $this->notificationCounter = $this->notificationCount();
            
        $this->notifications = auth()->user()->unreadNotifications;

        // $this->notifications = Notification::all();
        
        return view('livewire.admin-panel.notifications', [
            'notificationCounter' => $this->notificationCounter,
            'notifications' => $this->notifications
        ]);
    }
}