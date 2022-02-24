<?php

namespace App\Http\Livewire\Dashboard\User\Review\Facility;

use Livewire\Component;
use App\Models\FacilityReview;

class Index extends Component
{
    public $reviews;
    public $review;
    public $star;
    public $message;

    protected $listeners = ['review:edited' => 'reviewEdited', 'review:deleted' => 'reviewDeleted'];

    public function reviewEdited()
    {
        $this->dispatchBrowserEvent('review:edited');
    }

    public function reviewDeleted()
    {
        $this->dispatchBrowserEvent('review:deleted');
    }

    public function render()
    {
        return view('livewire.dashboard.user.review.facility.index')->layoutData(['title' => 'Facility Review Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill(['reviews' => auth()->user()->facility_reviews]);
    }

    public function edit(FacilityReview $facilityReview)
    {
        $this->dispatchBrowserEvent('review:edit');
        $this->fill([
            'review' => $facilityReview,
            'star' => $facilityReview->star,
            'message' => $facilityReview->message
        ]);
    }

    public function update()
    {
        $validatedData = $this->validate([
            'message' => ['required'],
            'star' => ['required']
        ]);

        $this->review->update($validatedData);

        $allReviews = FacilityReview::where('facility_code', $this->review->facility->code)->get();

        if (count($allReviews) > 0) {
            $rate = 0;

            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        } else {
            $rate = 0;
        }

        $this->review->facility->update(['rate' => $rate]);

        $this->emitSelf('review:edited');
    }

    public function setRating($val)
    {
        if ($this->star == $val) {
            $this->star = null;
        } else {
            $this->star = $val;
        }
    }

    public function delete(FacilityReview $facilityReview)
    {
        $this->dispatchBrowserEvent('review:delete');
        $this->fill([
            'review' => $facilityReview,
            'star' => $facilityReview->star,
            'message' => $facilityReview->message
        ]);
    }

    public function destroy()
    {
        $allReviews = FacilityReview::where('facility_code', $this->review->code)->where('code', '<>', $this->review->code)->get();
        
        $rate = 0;

        if (count($allReviews) > 0) {
            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        }

        $this->review->facility->update(['rate' => $rate]);
        $this->review->delete();
        $this->emitSelf('review:deleted');
    }
}
