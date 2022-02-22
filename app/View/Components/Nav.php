<?php

namespace App\View\Components;

use App\Models\Facility;
use Illuminate\View\Component;

class Nav extends Component
{
    public $dashboardLink;
    public $facilities;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->facilities = Facility::latest()->orderBy('type')->orderBy('name')->get();

        if (auth()->check()) {
            // if (auth()->user()->hasRole('visitor')) {
            //     $this->dashboardLink = route('dashboard.user');
            // }

            // if (auth()->user()->hasRole('recepsionist')) {
            //     $this->dashboardLink = route('dashboard.recepsionist');
            // }

            if (auth()->user()->hasRole('admin')) {
                $this->dashboardLink = route('dashboard.admin.index');
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
