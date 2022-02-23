<?php

namespace App\Http\Livewire\Dashboard\User\Reservation;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class Proof extends Controller
{
    public function render(Reservation $reservation)
    {
        $total_days = Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out);
        $pdf = Pdf::loadView('livewire.dashboard.user.reservation.proof', ['reservation' => $reservation, 'total_days' => $total_days]);
        return $pdf->download($reservation->code . '.pdf');
    }
}
