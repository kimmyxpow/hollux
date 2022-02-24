<?php

namespace App\Http\Livewire\Facility;

use App\Models\Facility;
use Livewire\Component;

class Index extends Component
{
    public $facility;
    public $facilities;
    public $reviews;

    protected $listeners = ['review:created' => 'reviewCreated', 'review:edited' => 'reviewEdited'];

    public function reviewCreated()
    {
        $this->dispatchBrowserEvent('review:created');
        $this->fill([
            'facility' => $this->facility,
            'reviews' => $this->facility->reviews
        ]);
    }

    public function reviewEdited()
    {
        $this->dispatchBrowserEvent('review:edited');
        $this->fill([
            'facility' => $this->facility,
            'reviews' => $this->facility->reviews
        ]);
    }

    public function render()
    {
        return view('livewire.facility.index')->layout('layouts.main', ['title' => 'Facilities | Hollux']);
    }

    public function mount(Facility $facility)
    {
        $this->fill([
            'facility' => $facility,
            'facilities' => Facility::orderBy('type')->get(),
            'reviews' => $facility->reviews
        ]);

        $this->facility->views += 1;
        $this->facility->save();
    }
}
