<?php

namespace App\Console\Commands;

use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LocationUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update location status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = Http::get('https://static.pipezero.com/covid/data.json')
            ->json('locations');

        foreach ($locations as $location) {
            Location::updateOrCreate([
                'name' => $location['name'],
            ], [
                'death' => $location['death'],
                'treating' => $location['treating'],
                'cases' => $location['cases'],
                'recovered' => $location['recovered'],
                'cases_today' => $location['casesToday'],
            ]);
        }

        $this->info('Locations updated');

        return 0;
    }
}
