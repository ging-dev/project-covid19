<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class IctuCase extends Component
{
    const API_URL = 'https://apps.ictu.vn:9081/covid/api/v1/user-profile';

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.ictu-case', [
            'data' => $this->getDataFromAPI(),
        ]);
    }

    /**
     * @return list<string>
     */
    protected function getDataFromAPI(): array
    {
        if (Cache::has('ictu-case')) {
            return Cache::get('ictu-case');
        }

        $data = Http::get(self::API_URL, [
            'condition' => 'trang_thai_f,=,0',
            'limit' => 10,
        ])->collect('data')
            ->pluck('full_name')
            ->toArray();

        Cache::put('ictu-case', $data, now()->addDay());

        return $data;
    }
}
