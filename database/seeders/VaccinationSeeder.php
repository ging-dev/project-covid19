<?php

namespace Database\Seeders;

use App\Models\VaccinationStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(database_path('seed.json')), true);
        foreach ($data as $item) {
            VaccinationStatus::insert(\array_merge($item, ['user_id' => 1]));
        }
    }
}
