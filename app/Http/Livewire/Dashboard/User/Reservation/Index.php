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
            'reservations' => Reservation::where('user_id', auth()->id())->paginate(5)
        ])->layoutData(['title' => 'Reservation Dashboard | Hollux']);
    }

    public function cancel($code)
    {
        $this->selected_reservation = $code;
    }

    public function canceled()
    {
        $this->validate([
            'message' => ['required']
        ]);

        Reservation::firstWhere('code', $this->selected_reservation)->update(['status' => 'canceled', 'message' => $this->message]);
        $this->emitSelf('reservation:canceled');
    }
}
