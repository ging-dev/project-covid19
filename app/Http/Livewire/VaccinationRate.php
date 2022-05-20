<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Livewire\Component;

class VaccinationRate extends Component
{
    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $data = VaccinationStatus::selectRaw(
            'count(*) as count, number_injected'
        )->groupBy('number_injected')
            ->pluck('count', 'number_injected')
            ->toArray();

        return view('livewire.vaccination-rate', [
            'data' => $data,
        ]);
    }
}
