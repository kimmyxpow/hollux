<?php

namespace App\Http\Livewire\Room\Review;

use App\Models\Room;
use App\Models\RoomReview;
use Livewire\Component;

class Create extends Component
{
    public $message;
    public $star;
    public $room;

    public function render()
    {
        return view('livewire.room.review.create');
    }

    public function mount($room)
    {
        $this->room = $room;
    }

    public function store()
    {
        if (!auth()->check()) {
            return $this->dispatchBrowserEvent('review:login');
        }

        if (!auth()->user()->hasVerifiedEmail()) {
            return $this->dispatchBrowserEvent('review:verified');
        }

        if (!auth()->user()->hasRole('user')) {
            return $this->dispatchBrowserEvent('review:forbidden');
        }

        $validatedData = $this->validate([
            'message' => ['required'],
            'star' => ['required']
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['room_code'] = $this->room->code;
        $validatedData['date'] = date('Y-m-d');
        $validatedData['code'] = bin2hex(random_bytes(20));

        RoomReview::create($validatedData);

        $allReviews = RoomReview::where('room_code', $this->room->code)->get();

        if (count($allReviews) > 0) {
            $rate = 0;

            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        } else {
            $rate = 0;
        }

        $this->room->update(['rate' => $rate]);

        $this->message = null;
        $this->star = null;

        $this->emit('review:created');
    }

    public function setRating($val)
    {
        if ($this->star == $val) {
            $this->star = null;
        } else {
            $this->star = $val;
        }
    }
}
