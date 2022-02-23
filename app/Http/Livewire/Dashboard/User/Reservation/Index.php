<?php

namespace App\Http\Livewire\Dashboard\User\Reservation;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.dashboard.user.reservation.index', [
            'reservations' => Reservation::where('user_id', auth()->id())->paginate(5)
        ])->layoutData(['title' => 'Reservation Dashboard | Hollux']);
    }
}
