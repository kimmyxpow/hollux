<?php

namespace App\Http\Livewire\Dashboard\Admin\Facility;

use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedFacility;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.dashboard.admin.facility.index', [
            'facilities' => Facility::filter(['search' => $this->search])->latest()->paginate(10)
        ])->layoutData(['title' => 'Facility Dashboard | Hollux']);
    }

    public function mount()
    {
        $this->fill(['selectedFacility' => Facility::first()]);
    }

    public function delete(Facility $facility)
    {
        $this->dispatchBrowserEvent('facility:delete');
        $this->selectedFacility = $facility;
    }

    public function destroy()
    {
        Storage::delete($this->selectedFacility->image);
        $this->selectedFacility->delete();
        $this->dispatchBrowserEvent('facility:deleted');
    }

    public function show(Facility $facility)
    {
        $this->dispatchBrowserEvent('facility:show');
        $this->selectedFacility = $facility;
    }

    public function cancel()
    {
        $this->fill(['selectedFacility' => Facility::first()]);
    }
}
