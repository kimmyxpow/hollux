<?php

namespace App\Http\Livewire\Dashboard\Admin\Room;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomHasFacility;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $room;
    public $name;
    public $total_rooms;
    public $description;
    public $price;
    public $explanation;
    public $image;
    public array $selectedFacilities;
    public $facilities;
    public $roomFacilities;
    public $oldImage;

    public function render()
    {
        return view('livewire.dashboard.admin.room.edit')->layoutData(['title' => 'Edit Room | Hollux']);
    }

    public function mount(Room $room)
    {
        $this->fill([
            'room' => $room,
            'roomFacilities' => $room->facilities->pluck('facility_code')->toArray(),
            'name' => $room->name,
            'price' => $room->price,
            'total_rooms' => $room->total_rooms,
            'description' => $room->description,
            'oldImage' => $room->image,
            'explanation' => $room->explanation,
            'facilities' => Facility::where('type', 'room')->get(),
        ]);

        $facilities = [];

        foreach ($this->facilities->pluck('code') as $facility) {
            $facilities[$facility] = in_array($facility, $this->roomFacilities) ? $facility : false; 
        }

        $this->fill(['selectedFacilities' => $facilities]);
    }

    public function update()
    { 
        $rules = [
            'name' => ['required'],
            'description' => ['required'],
            'total_rooms' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'explanation' => ['required'],
        ];

        if ($this->image) {
            $rules['image'] = ['required', 'image', 'max:2084'];
        }

        $validatedData = $this->validate($rules);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('img/rooms');
            Storage::delete($this->room->image);
        }

        $this->room->update($validatedData);

        RoomHasFacility::where('room_id', $this->room->id)->delete();

        if (count(array_filter($this->selectedFacilities))) {
            foreach (array_filter($this->selectedFacilities) as $facility) {
                RoomHasFacility::create([
                    'room_id' => $this->room->id,
                    'facility_code' => $facility
                ]);
            }
        }

        $this->dispatchBrowserEvent('room:edited');
    }
}
