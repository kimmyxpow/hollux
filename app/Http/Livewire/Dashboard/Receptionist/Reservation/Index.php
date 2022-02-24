<?php

namespace App\Http\Livewire\Dashboard\Receptionist\Reservation;

use App\Models\Reservation;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $check_in;
    public $status;

    protected $queryString = [
        'search' => ['except' => ''],
        'check_in' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    protected $listeners = ['status:confirmed' => 'statusConfirmed', 'status:checkin' => 'statusCheckIn', 'status:checkout' => 'statusCheckOut'];

    public function render()
    {
        return view('livewire.dashboard.receptionist.reservation.index', [
            'reservations' => Reservation::filter(['search' => $this->search, 'check_in' => $this->check_in, 'status' => $this->status])->latest()->paginate(50)
        ])->layoutData(['title' => 'Reservation | Hollux']);
    }

    public function confirm($code)
    {
        $reservation = Reservation::firstWhere('code', $code);
        $reservation->update(['status' => 'confirmed']);
        $this->emitSelf('status:confirmed');
    }

    public function checkIn($code)
    {
        $reservation = Reservation::firstWhere('code', $code);
        $reservation->update(['status' => 'check in']);
        $this->emitSelf('status:checkin');
    }

    public function checkOut($code)
    {
        $reservation = Reservation::firstWhere('code', $code);
        $room = Room::firstWhere('code', $reservation->room->code);
        $reservation->update(['status' => 'check out']);
        $room->available = $room->total_rooms - array_sum($room->reservations->where('status', '<>', 'canceled')->where('status', '<>', 'check out')->pluck('total_rooms')->toArray());
        $room->save();
        $this->emitSelf('status:checkout');
    }

    public function statusConfirmed()
    {
        $this->dispatchBrowserEvent('status:confirmed');
    }

    public function statusCheckIn()
    {
        $this->dispatchBrowserEvent('status:checkin');
    }

    public function statusCheckOut()
    {
        $this->dispatchBrowserEvent('status:checkout');
    }
}
