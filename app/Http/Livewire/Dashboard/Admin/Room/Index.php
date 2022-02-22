<?php

namespace App\Http\Livewire\Dashboard\Admin\Room;

use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedRoom;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.dashboard.admin.room.index', [
            'rooms' => Room::filter(['search' => $this->search])->latest()->paginate(10)
        ])->layoutData(['title' => 'Room Dashboard | Hollux']);
    }

    public function mount()
    {

        $this->fill(['selectedRoom' => Room::first()]);
    }

    public function show(Room $room)
    {
        $this->dispatchBrowserEvent('room:show');
        $this->selectedRoom = $room;
    }

    public function delete(Room $room)
    {
        $this->dispatchBrowserEvent('room:delete');
        $this->selectedRoom = $room;
    }

    public function destroy()
    {
        Storage::delete($this->selectedRoom->image);
        $this->selectedRoom->delete();
        $this->dispatchBrowserEvent('room:deleted');
    }

    public function cancel()
    {
        $this->fill(['selectedRoom' => Room::first()]);
    }
}
