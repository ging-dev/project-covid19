<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Livewire\Component;

class VaccinationRate extends Component
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $collection = VaccinationStatus::selectRaw(
                'count(*) as count, number_injected'
            )->groupBy('number_injected')
            ->pluck('count', 'number_injected');

        return view('livewire.vaccination-rate', [
            'titles' => $collection->keys(),
            'values' => $collection->values(),
        ]);
    }
}
