<?php

namespace App\Http\Livewire\Dashboard\Receptionist\Reservation;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class Proof extends Component
{
    public function render(Reservation $reservation)
    {
        $total_days = Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out);
        $pdf = Pdf::loadView('livewire.dashboard.receptionist.reservation.proof', ['reservation' => $reservation, 'total_days' => $total_days]);
        return $pdf->stream($reservation->code . '.pdf');
    }
}
