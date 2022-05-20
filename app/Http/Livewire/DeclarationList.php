<?php

namespace App\Http\Livewire;

use App\Models\VaccinationStatus;
use Livewire\Component;
use Livewire\WithPagination;

class DeclarationList extends Component
{
    use WithPagination;

    /** @var string */
    protected $paginationTheme = 'bootstrap';

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.declaration-list', [
            'statuses' => VaccinationStatus::with('user')->orderBy('updated_at', 'desc')
                ->paginate(5),
        ]);
    }
}
