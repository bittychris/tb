<?php

namespace App\Livewire\AdminPanel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
        if(auth()->user()->role->name == 'Admin') {
            
            $this->notificationCounter = $this->notificationCount();
            
            $this->notifications = auth()->user()->unreadNotifications;
            
        } elseif(auth()->user()->role->name == 'AMREF personnel') {
            
            $this->notifications = DB::table('notifications')->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(data, "$.role")) = ?', ['AMREF personnel'])
                ->get();
            
            $this->notificationCounter = $this->notifications->count();
        }
        
        return view('livewire.admin-panel.notifications', [
            'notificationCounter' => $this->notificationCounter,
            'notifications' => $this->notifications
        ]);
    }
}