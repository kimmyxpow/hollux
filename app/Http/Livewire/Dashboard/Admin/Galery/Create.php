<?php

namespace App\Http\Livewire\Dashboard\Admin\Galery;

use App\Models\Galery;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $image;
    public $title;

    public function render()
    {
        return view('livewire.dashboard.admin.galery.create');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'image' => ['required', 'image', 'max:2048'],
            'title' => ['required'],
        ]);

        $validatedData['image'] =  $this->image->store('img/galeries');
        $validatedData['code'] = bin2hex(random_bytes(20));

        Galery::create($validatedData);

        $this->dispatchBrowserEvent('galery:created');
        $this->emit('galery:created');
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->image = null;
        $this->title = null;
    }
}
