<?php

namespace App\Http\Livewire\Dashboard\Admin\Facility;

use App\Models\Facility;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $type = 'public';
    public $explanation;
    public $image;

    public function render()
    {
        return view('livewire.dashboard.admin.facility.create')->layoutData(['title' => 'New Facility | Hollux']);
    }

    public function store() {
        $validatedData = $this->validate([
            'name' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'explanation' => ['required'],
            'image' => ['required', 'image', 'max:2084'],
        ]);

        $validatedData['image'] = $this->image->store('img/facilities');
        $validatedData['code'] = bin2hex(random_bytes(20));

        Facility::create($validatedData);

        $this->dispatchBrowserEvent('facility:created');
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->reset(['name', 'description', 'explanation', 'image']);
        $this->fill(['type' => 'public']);
    }
}
