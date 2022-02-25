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
        $rate = VaccinationStatus::selectRaw('count(*) as count')
            ->groupBy('number_injected')
            ->pluck('count')
            ->toArray();

        return view('livewire.vaccination-rate', [
            'rate' => $rate,
        ]);
    }
}
