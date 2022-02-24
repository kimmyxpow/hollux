<?php

namespace App\Http\Livewire\Room\Review;

use App\Models\RoomReview;
use Livewire\Component;

class Edit extends Component
{
    public $message;
    public $star;
    public $room;
    public $review;

    public function render()
    {
        return view('livewire.room.review.edit');
    }

    public function mount($review, $room)
    {
        $this->review = $review;
        $this->room = $room;
        $this->message = $review['message'];
        $this->star = $review['star'];
    }

    public function update()
    {
        if (!auth()->check()) {
            return to_route('login');
        }

        $validatedData = $this->validate([
            'message' => ['required'],
            'star' => ['required']
        ]);

        $this->review->update($validatedData);

        $allReviews = RoomReview::where('room_code', $this->room->code)->get();

        if (count($allReviews) > 0) {
            $rate = 0;

            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        } else {
            $rate = $this->star;
        }

        $this->room->update(['rate' => $rate]);

        $this->emit('review:edited');
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
