<?php

namespace App\Http\Livewire\Facility\Review;

use App\Models\FacilityReview;
use Livewire\Component;

class Edit extends Component
{
    public $message;
    public $star;
    public $facility;
    public $review;

    public function render()
    {
        return view('livewire.facility.review.edit');
    }

    public function mount($review, $facility)
    {
        $this->review = $review;
        $this->facility = $facility;
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

        $allReviews = FacilityReview::where('facility_code', $this->facility->code)->get();

        if (count($allReviews) > 0) {
            $rate = 0;

            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        } else {
            $rate = $this->star;
        }

        $this->facility->update(['rate' => $rate]);

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
