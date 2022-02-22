<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class LocationStat extends Component
{
    use WithPagination;

    /** @var string */
    protected $paginationTheme = 'bootstrap';

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.location', [
            'locations' => Location::query()->paginate(10, pageName: 'locationPage'),
        ]);
    }
}
