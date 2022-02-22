<?php

namespace App\Http\Livewire\Dashboard\Admin;

use App\Models\About;
use App\Models\Facility;
use App\Models\Galery;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $totalRooms;
    public $totalFacilities;
    public $totalGalery;
    public $about;
    public $image;
    public $text;
    public $title;

    public function render()
    {
        return view('livewire.dashboard.admin.index')->layoutData(['title' => 'Admin Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill([
            'totalRooms' => Room::latest()->get()->count(),
            'totalFacilities' => Facility::latest()->get()->count(),
            'totalGalery' => Galery::latest()->get()->count(),
            'about' => About::first(),
        ]);

        $this->fill([
            'title' => $this->about->title,
            'text' => $this->about->text,
        ]);
    }

    public function update()
    {
        $rules = [
            'title' => ['required'],
            'text' => ['required'],
        ];

        if ($this->image) {
            $rules['image'] = ['required', 'image', 'max:2048'];
        }

        $validatedData = $this->validate($rules);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('img/about');
            Storage::delete($this->about->image);
        }

        $this->about->update($validatedData);
        $this->dispatchBrowserEvent('about:updated');
    }

    public function resetAll()
    {
        $this->fill([
            'title' => $this->about->title,
            'text' => $this->about->text,
        ]);

        $this->reset('image');
    }
}
