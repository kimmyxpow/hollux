<?php

namespace App\Http\Livewire\Dashboard\User\Review\Room;

use App\Models\RoomReview;
use Livewire\Component;

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
        return view('livewire.dashboard.user.review.room.index')->layoutData(['title' => 'Room Review Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill(['reviews' => auth()->user()->room_reviews]);
    }

    public function edit(RoomReview $roomReview)
    {
        $this->dispatchBrowserEvent('review:edit');
        $this->fill([
            'review' => $roomReview,
            'star' => $roomReview->star,
            'message' => $roomReview->message
        ]);
    }

    public function update()
    {
        $validatedData = $this->validate([
            'message' => ['required'],
            'star' => ['required']
        ]);

        $this->review->update($validatedData);

        $allReviews = RoomReview::where('room_code', $this->review->room->code)->get();

        if (count($allReviews) > 0) {
            $rate = 0;

            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        } else {
            $rate = 0;
        }

        $this->review->room->update(['rate' => $rate]);

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

    public function delete(RoomReview $roomReview)
    {
        $this->dispatchBrowserEvent('review:delete');
        $this->fill([
            'review' => $roomReview,
            'star' => $roomReview->star,
            'message' => $roomReview->message
        ]);
    }

    public function destroy()
    {
        $allReviews = RoomReview::where('room_code', $this->review->code)->where('code', '<>', $this->review->code)->get();

        $rate = 0;

        if (count($allReviews) > 0) {
            foreach ($allReviews as $review) {
                $rate += $review->star;
            }

            $rate /= $allReviews->count();
        }

        $this->review->room->update(['rate' => $rate]);
        $this->review->delete();
        $this->emitSelf('review:deleted');
    }
}
