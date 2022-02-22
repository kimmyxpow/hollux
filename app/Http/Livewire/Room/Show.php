<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Show extends Component
{
    public $room;

    public function render()
    {
        return view('livewire.room.show')->layout('layouts.main', ['title' => $this->room->name . " Room | Hollux"]);
    }

    public function mount(Room $room)
    {
        $this->fill(['room' => $room]);
        $this->room->views += 1;
        $this->room->save();
    }
}
