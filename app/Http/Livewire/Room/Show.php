<?php

namespace App\Http\Livewire\Room;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $room;
    public $check_in;
    public $minCheckIn;
    public $check_out;
    public $minCheckOut;
    public $total_rooms;
    public $totalPrice;
    public $available;
    public $totalDays;
    public $reviews;

    protected $listeners = ['reservation:created' => 'reservationCreated', 'review:created' => 'reviewCreated', 'review:edited' => 'reviewEdited'];

    public function reservationCreated()
    {
        $this->dispatchBrowserEvent('reservation:created');
        $this->resetAll();

        $available = (int) $this->room->total_rooms -  (int) array_sum($this->room->reservations->where('status', '<>', 'canceled')->where('status', '<>', 'check out')->pluck('total_rooms')->toArray());
        
        $this->fill(['available' => $available]);

        $this->room->update([
            'available' =>  $this->available
        ]);
    }

    public function reviewCreated()
    {
        $this->dispatchBrowserEvent('review:created');
        $this->fill([
            'room' => $this->room,
            'reviews' => $this->room->reviews
        ]);
    }

    public function reviewEdited()
    {
        $this->dispatchBrowserEvent('review:edited');
        $this->fill([
            'room' => $this->room,
            'reviews' => $this->room->reviews
        ]);
    }

    public function render()
    {
        return view('livewire.room.show')->layout('layouts.main', ['title' => $this->room->name . " Room | Hollux"]);
    }

    public function mount(Room $room)
    {
        $this->fill([
            'room' => $room,
            'minCheckIn' => date('Y-m-d'),
            'minCheckOut' => Carbon::parse(date('Y-m-d'))->add(1, 'day')->toDateString(),
            'available' => $this->room->available,
            'reviews' => $room->reviews
        ]);
        $this->room->views += 1;
        $this->room->save();
    }

    public function reservation()
    {
        $validatedData = $this->validate([
            'check_in' => ['required', 'date', 'after:' . Carbon::parse($this->minCheckIn)->yesterday()->toDateString()],
            'check_out' => ['required', 'date', 'after:' . Carbon::parse($this->minCheckOut)->yesterday()->toDateString()],
            'total_rooms' => ['required', 'numeric', 'max:' . $this->available, 'min:1'],
        ]);

        $validatedData['room_id'] = $this->room->id;
        $validatedData['user_id'] = auth()->id();
        $validatedData['date'] = date('Y-m-d');
        $validatedData['status'] = 'waiting';
        $validatedData['total_price'] = $this->totalPrice;
        $validatedData['code'] = str(uniqid('HLX-') . date('Ymd'))->upper();
        
        Reservation::create($validatedData);

        $this->emitSelf('reservation:created');
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
        $this->fill([
            'totalPrice' => $this->total_rooms != 1 
                            ? (intval($this->room->price) * intval($this->total_rooms)) * intval($this->totalDays) 
                            : intval($this->room->price) * intval($this->totalDays)
        ]);
    }

    public function resetAll()
    {
        $this->resetExcept(['room', 'minCheckIn', 'minCheckOut', 'reviews']);
    }
}
