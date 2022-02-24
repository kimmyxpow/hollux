<?php

namespace App\Http\Livewire;

use App\Models\Facility;
use App\Models\Galery;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;

class Index extends Component
{
    public $favouriteRooms;
    public $gallery;
    public $facilities;
    public $rooms;
    public $selected_room;
    public $room_name;
    public $check_in;
    public $minCheckIn;
    public $check_out;
    public $minCheckOut;
    public $total_rooms;
    public $totalPrice;
    public $totalDays;
    
    public function render()
    {
        return view('livewire.index')->layout('layouts.main', ['title' => 'Make Your Vacation Easier  | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'favouriteRooms' => Room::orderBy('rate')->limit(3)->get(),
            'rooms' => Room::latest()->get(),
            'gallery' => Galery::all(),
            'facilities' => Facility::orderBy('type')->get(),
            'minCheckIn' => date('Y-m-d'),
            'minCheckOut' => Carbon::parse(date('Y-m-d'))->add(1, 'day')->toDateString(),
            'selected_room' => Room::first()->code,
        ]);
    }

    public function reservation()
    {
        $room = Room::firstWhere('code', $this->selected_room);

        $rules = [
            'check_in' => ['required', 'date', 'after:' . Carbon::parse($this->minCheckIn)->yesterday()->toDateString()],
            'check_out' => ['required', 'date', 'after:' . Carbon::parse($this->minCheckOut)->yesterday()->toDateString()],
            'selected_room' => ['required'],
            'total_rooms' => ['required', 'numeric', 'min:1'],
        ];

        if ($this->selected_room) {
            array_push($rules['total_rooms'], 'max:' . $room->available);
        }

        $validatedData = $this->validate($rules);
        
        $validatedData['room_id'] = $room->id;
        $validatedData['user_id'] = auth()->id();
        $validatedData['date'] = date('Y-m-d');
        $validatedData['status'] = 'waiting';
        $validatedData['total_price'] = $this->totalPrice;
        $validatedData['code'] = str(uniqid('HLX-') . date('Ymd'))->upper();
        unset($validatedData['selected_room']);

        Reservation::create($validatedData);

        $available = (int) $room->total_rooms -  (int) array_sum($room->reservations->where('status', '<>', 'canceled')->where('status', '<>', 'check out')->pluck('total_rooms')->toArray());
        $room->update(['available' =>  $available]);

        $this->dispatchBrowserEvent('reservation:created');
        $this->resetAll();
    }

    public function setCheckIn()
    {
        $this->fill(['minCheckOut' => Carbon::parse($this->check_in)->add(1, 'day')->toDateString()]);

        if ($this->check_in >= $this->check_out) {
            $this->reset('check_out');
        }

        if ($this->check_out !== null) {
            $this->totalDays = Carbon::parse($this->check_in)->diffInDays($this->check_out);
            $this->setPrice();
        }
    }

    public function setCheckOut()
    {
        if ($this->check_out <= $this->check_in) {
            $this->reset('check_in');
        }

        if ($this->check_in !== null) {
            $this->totalDays = Carbon::parse($this->check_in)->diffInDays($this->check_out);
            $this->setPrice();
        }
    }

    public function setPrice()
    {
        $room = Room::firstWhere('code', $this->selected_room);
        if ($this->selected_room) {
            $this->fill([
                'room_name' => $room->name,
                'totalPrice' => $this->total_rooms != 1
                    ? (intval($room->price) * intval($this->total_rooms)) * intval($this->totalDays)
                    : intval($room->price) * intval($this->totalDays)
            ]);
        }
    }

    public function resetAll()
    {
        $this->resetExcept(['favouriteRooms', 'rooms', 'gallery', 'facilities','minCheckIn', 'minCheckOut']);
        $this->fill(['selected_room' => Room::first()->code]);
    }
}
