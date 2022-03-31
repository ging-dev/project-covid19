<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = Http::get('https://static.pipezero.com/covid/data.json')
            ->json('locations');

        foreach ($locations as $location) {
            Location::insert([
                'name' => $location['name'],
                'death' => $location['death'],
                'treating' => $location['treating'],
                'cases' => $location['cases'],
                'recovered' => $location['recovered'],
                'cases_today' => $location['casesToday'],
            ]);
        }
    }
}
