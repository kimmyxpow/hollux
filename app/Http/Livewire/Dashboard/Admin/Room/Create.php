<?php

namespace App\Http\Livewire\Dashboard\Admin\Room;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomHasFacility;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $total_rooms;
    public $description;
    public $price;
    public $explanation;
    public $image;
    public array $selectedFacilities;
    public $facilities;

    public function render()
    {
        return view('livewire.dashboard.admin.room.create')->layoutData(['title' => 'New Room | Hollux']);
    }

    public function mount()
    {
        $this->fill(['facilities' => Facility::where('type', 'room')->get()]);
        $this->fill(['selectedFacilities' => array_fill_keys($this->facilities->pluck('code')->toArray(), false)]);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => ['required'],
            'description' => ['required'],
            'total_rooms' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'explanation' => ['required'],
            'image' => ['required', 'image', 'max:2084'],
        ]);

        $validatedData['image'] = $this->image->store('img/rooms');
        $validatedData['code'] = bin2hex(random_bytes(20));
        $validatedData['available'] = $this->total_rooms;

        $roomId = Room::create($validatedData);

        if (count(array_filter($this->selectedFacilities))) {
            foreach (array_filter($this->selectedFacilities) as $facility) {
                RoomHasFacility::create([
                    'room_id' => $roomId->id,
                    'facility_code' => $facility
                ]);
            }
        }

        $this->dispatchBrowserEvent('room:created');
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->reset(['name', 'total_rooms', 'description', 'price', 'explanation', 'image']);
        $this->fill(['selectedFacilities' => array_fill_keys($this->facilities->pluck('code')->toArray(), false)]);
    }
}
