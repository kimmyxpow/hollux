<?php

namespace App\Http\Livewire;

use App\Models\Facility;
use App\Models\Galery;
use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public $favouriteRooms;
    public $gallery;
    public $facilities;

    public function render()
    {
        return view('livewire.index')->layout('layouts.main', ['title' => 'Make Your Vacation Easier  | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'favouriteRooms' => Room::orderBy('rate')->limit(3)->get(),
            'gallery' => Galery::all(),
            'facilities' => Facility::orderBy('type')->get(),
        ]);
    }
}
