<?php

namespace App\Http\Livewire\Dashboard\Receptionist;

use App\Models\Reservation;
use Livewire\Component;

class Index extends Component
{
    public $totalReservations;
    public $totalReservationsWaiting;
    public $totalReservationsCanceled;
    public $totalReservationsConfirmed;
    public $totalReservationsCheckIn;
    public $totalReservationsCheckOut;

    public function render()
    {
        return view('livewire.dashboard.receptionist.index')->layoutData(['title' => 'Receptionist Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'totalReservations' => Reservation::all()->count(),
            'totalReservationsWaiting' => Reservation::where('status', 'waiting')->count(),
            'totalReservationsCanceled' => Reservation::where('status', 'canceled')->count(),
            'totalReservationsConfirmed' => Reservation::where('status', 'confirmed')->count(),
            'totalReservationsCheckIn' => Reservation::where('status', 'check in')->count(),
            'totalReservationsCheckOut' => Reservation::where('status', 'check out')->count(),
        ]);
    }
}
