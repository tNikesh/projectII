<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $notifications = [];

    protected $listeners = ['notification'];


    public function notification($data)
    {
        $this->notifications[] = [
            'message' => $data['message'],
            'type' => $data['type'],
            'show' => true,
        ];
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
