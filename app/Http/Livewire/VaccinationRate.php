<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Livewire\Component;

class VaccinationRate extends Component
{
    public function render()
    {
        $rate = VaccinationStatus::selectRaw('count(*) as count')
            ->groupBy('number_injected')
            ->get()
            ->pluck('count')
            ->toArray();

        return view('livewire.vaccination-rate', [
            'rate' => $rate,
        ]);
    }
}
