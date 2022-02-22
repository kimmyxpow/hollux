<?php

namespace App\Http\Livewire\Dashboard\Admin\Facility;

use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $facility;
    public $name;
    public $description;
    public $type;
    public $explanation;
    public $image;
    public $oldImage;

    protected $listeners = ['facility:edited' => 'facilityEdited'];
    
    public function render()
    {
        return view('livewire.dashboard.admin.facility.edit')->layoutData(['title' => 'Edit Fasilitas | Hollux']);
    }

    public function mount(Facility $facility)
    {
        $this->facility = $facility;
        $this->name = $facility->name;
        $this->description = $facility->description;
        $this->type = $facility->type;
        $this->explanation = $facility->explanation;
        $this->oldImage = $facility->image;
    }

    public function update()
    {
        $rules = [
            'name' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'explanation' => ['required'],
        ];

        if ($this->image) {
            $rules['image'] = ['image', 'max:2084'];
        }

        $validatedData = $this->validate($rules);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('img/facilities');
            Storage::delete($this->facility->image);
        }

        $this->facility->update($validatedData);

        $this->dispatchBrowserEvent('facility:edited');
        $this->emitSelf('facility:edited');
    }

    public function facilityEdited()
    {
        //
    }
}
