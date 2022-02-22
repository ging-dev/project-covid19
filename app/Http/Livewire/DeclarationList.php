<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Livewire\Component;

class DeclarationList extends Component
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.declaration-list', [
            'statuses' => VaccinationStatus::query()
                ->orderBy('updated_at', 'desc')
                ->paginate(10),
        ]);
    }
}
