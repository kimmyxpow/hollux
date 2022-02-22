<?php

namespace App\Http\Livewire\Dashboard\Admin\Galery;

use Livewire\Component;
use App\Models\Galery;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    
    public $selectedGalery;
    public $new_image;
    public $oldImage;
    public $title;

    protected $listeners = ['galery:created' => 'galeryCreated'];

    public function render()
    {
        return view('livewire.dashboard.admin.galery.index', [
            'galeries' => Galery::latest()->get()
        ])->layoutData(['title' => 'Galery Dashboard | Hollux']);
    }

    public function edit(Galery $galery)
    {
        $this->dispatchBrowserEvent('galery:edit');
        $this->selectedGalery = $galery;
        $this->oldImage = $this->selectedGalery->image;
        $this->title = $this->selectedGalery->title;
    }

    public function delete(Galery $galery)
    {
        $this->dispatchBrowserEvent('galery:delete');
        $this->selectedGalery = $galery;
    }

    public function galeryCreated()
    {
        //
    }

    public function update()
    {
        $rules = [
            'title' => ['required'],
        ];

        if ($this->new_image) {
            $rules['new_image'] = ['file', 'image', 'max:2048'];
        }

        $validatedData = $this->validate($rules);

        if ($this->new_image) {
            $validatedData['image'] =  $this->new_image->store('img/galeries');
            unset($validatedData['new_image']);
            Storage::delete($this->selectedGalery->image);
        }

        $this->selectedGalery->update($validatedData);

        $this->dispatchBrowserEvent('galery:edited');
        $this->resetAll();
    }

    public function destroy()
    {
        Storage::delete($this->selectedGalery->image);
        $this->selectedGalery->delete();
        $this->dispatchBrowserEvent('galery:deleted');
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->reset(['selectedGalery', 'oldImage', 'new_image', 'title']);
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
