<?php

namespace App\Http\Livewire\Facility\Review;

use App\Models\FacilityReview;
use Livewire\Component;

class Create extends Component
{
    public $message;
    public $star;
    public $facility;

    public function render()
    {
        return view('livewire.facility.review.create');
    }

    public function mount($facility)
    {
        $this->facility = $facility;
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
        $validatedData['facility_code'] = $this->facility->code;
        $validatedData['date'] = date('Y-m-d');
        $validatedData['code'] = bin2hex(random_bytes(20));

        FacilityReview::create($validatedData);

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
