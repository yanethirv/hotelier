<?php

namespace App\Http\Livewire\Communication\Notifications;


use Livewire\Component;
use Livewire\WithPagination;

class NotificationTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'notificationListUpdated' => 'render',
    ];

    public function render()
    {
        $notifications = auth()->user()->unreadNotifications()->paginate($this->perPage);

        return view('livewire.communication.notifications.notification-table', compact('notifications'));
    }


    public function updatingSearch(){
        $this->resetPage();
    }


    public function markAsRead($id){
        
        auth()->user()->unreadNotifications->when($id, function ($query) use ($id) {
            return $query->where('increment', $id);
        })->markAsRead();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Notification marked as read',
            'text' => '',
            ]);

    }

    public function markAllAsRead(){
        
        auth()->user()->unreadNotifications->markAsRead();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Notification marked as read',
            'text' => '',
            ]);

    }

}
