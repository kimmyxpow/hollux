<?php

namespace App\Http\Livewire\Dashboard\User\Reservation;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selected_reservation;
    public $message;

    protected $listeners = ['reservation:canceled' => 'reservationcanceled'];

    public function reservationcanceled()
    {
        $this->dispatchBrowserEvent('reservation:canceled');
    }

    public function render()
    {
        return view('livewire.dashboard.user.reservation.index', [
            'reservations' => Reservation::where('user_id', auth()->id())->latest()->paginate(5)
        ])->layoutData(['title' => 'Reservation Dashboard | Hollux']);
    }

    public function cancel($code)
    {
        $this->selected_reservation = $code;
    }

    public function canceled()
    {
        $this->validate(['message' => ['required']]);

        $reservation = Reservation::firstWhere('code', $this->selected_reservation);
        $room = Room::firstWhere('code', $reservation->room->code);
        
        $reservation->update(['status' => 'canceled', 'message' => $this->message]);

        $available = $room->total_rooms - array_sum($room->reservations->where('status', '<>', 'canceled')->where('status', '<>', 'check out')->pluck('total_rooms')->toArray());
        $room->update(['available' => $available]);

        $this->emitSelf('reservation:canceled');
    }
}
