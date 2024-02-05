<?php

namespace App\Livewire\AdminPanel;

use Livewire\Component;
use App\Models\comments;

class CommentNotifier extends Component
{
    public $unread_comment_count, $comments;

    public function goToReport($form_id) {
        if($form_id) {
            if(auth()->user()->role->name == 'Regional coordinator') {
                return redirect(route('admin.report.comment', ['form' => $form_id]));

            } elseif(auth()->user()->role->name == 'AMREF personnel') {
                return redirect(route('admin.reporting.comment', ['report' => $form_id]));

            } else {
                $this->dispatch('message_alert', 'You can\'t the Comment since you are neither RC nor ASP.');

            }

        } else {
            $this->dispatch('message_alert', 'No Comment selected.');

        }

    }

    public function reloadComments() {
        $this->comments = comments::where(function ($query) {
            $query->where('receiver_id', auth()->user()->id);
                  // ->orWhere('receiver_id', auth()->user()->id);

        })->where('read_at', null)
        ->orderBy('created_at', 'asc')->get();

        $this->unread_comment_count = comments::where('receiver_id', auth()->user()->id)
                       ->where('read_at', null)->count();

    }

    public function render()
    {
        // Comments
        $this->comments = comments::where(function ($query) {
                      $query->where('receiver_id', auth()->user()->id);
                            // ->orWhere('receiver_id', auth()->user()->id);

                  })->where('read_at', null)
                  ->orderBy('created_at', 'asc')->get();

        $this->unread_comment_count = comments::where('receiver_id', auth()->user()->id)
                                 ->where('read_at', null)->count();

        return view('livewire.admin-panel.comment-notifier');
    }
}
