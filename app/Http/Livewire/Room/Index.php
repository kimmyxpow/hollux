<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public $rooms;

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.main', ['title' => 'Rooms | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'rooms' => Room::orderBy('created_at')->get()
        ]);
    }
}
