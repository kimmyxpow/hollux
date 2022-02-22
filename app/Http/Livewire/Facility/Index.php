<?php

namespace App\Http\Livewire\Facility;

use App\Models\Facility;
use Livewire\Component;

class Index extends Component
{
    public $facility;
    public $facilities;

    public function render()
    {
        return view('livewire.facility.index')->layout('layouts.main', ['title' => 'Facilities | Hollux']);
    }

    public function mount(Facility $facility)
    {
        $this->fill([
            'facility' => $facility,
            'facilities' => Facility::orderBy('type')->get()
        ]);

        $this->facility->views += 1;
        $this->facility->save();
    }
}
