<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\FacilityReview;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $totalFacilityReviews;
    public $totalRoomReviews;
    public $totalReservations;

    public function render()
    {
        return view('livewire.dashboard.user.index')->layoutData(['title' => 'User Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'totalFacilityReviews' => auth()->user()->facility_reviews->count(),
            'totalRoomReviews' => auth()->user()->room_reviews->count(),
            'totalReservations' => auth()->user()->reservations->count(),
        ]);
    }
}
