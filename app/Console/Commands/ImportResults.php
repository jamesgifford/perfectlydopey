<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Result;
use Config;

class ImportResults extends Command
{
    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature = 'results:import {year : The year of the results}';

    /**
     * The console command description
     * @var string
     */
    protected $description = 'Import Dopey Challenge results from a stored csv file';

    /**
     * Create a new command instance
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command
     * @return mixed
     */
    public function handle()
    {
        $year = $this->argument('year');
        $file = 'dopey_results_'.$year.'.csv';

        $this->info('Importing results for ' . $year . '...');

        try {
            $handle = fopen(storage_path('/app/csv/'.$file), 'r');
        }
        catch (\ErrorException $e) {
            $this->error('Could not open results file');
            return;
        }

        $insertCount = $duplicateCount = 0;

        $states = Config::get('location.states');
        $countries = Config::get('location.countries');

        // Get one line of the csv file at a time
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $name = explode(',', $data[0]);
            $location = explode(',', $data[7]);

            $lastName = trim(array_shift($name));
            $firstName = trim(array_pop($name));

            $city = $state = $country = '';
            $city = trim(array_shift($location));

            if (count($location)) {
                $state = trim(array_pop($location));
                $country = in_array(strtoupper($state), array_keys($states)) ? 'United States' : $state;
                $country = explode('(', $country);
                $country = trim(array_shift($country));
            }

            if ($country != 'United States') {
                $state = '';
            }

            if (strlen($country) > 1) {
                foreach ($countries as $countryCode => $countryName) {
                    if (strpos(strtoupper($countryName), strtoupper($country)) === 0) {
                        $country = trim($countryCode);
                        break;
                    }
                }
            }

            $result = new Result();
            $result->year = $year;
            $result->full_name = $data[0];
            $result->first_name = $firstName;
            $result->last_name = $lastName;
            $result->age = $data[1];
            $result->gender = $data[2];
            $result->{'5k_time'} = $data[3];
            $result->{'10k_time'} = $data[4];
            $result->half_time = $data[5];
            $result->full_time = $data[6];
            $result->location = $data[7];
            $result->city = $city;
            $result->state = $state;
            $result->country = $country;

            try {
                $result->save();
                $insertCount++;
            } catch (\Illuminate\Database\QueryException $e) {
                $duplicateCount++;
                $this->line('Duplicate: ' . $result->full_name . ' - ' . $result->age . ' - ' . $result->location);
                continue;
            }
        }

        $this->comment($insertCount + $duplicateCount . ' results found');
        $this->comment($insertCount . ' results imported');
        $this->comment($duplicateCount . ' duplicate results skipped');

        fclose($handle);
    }
}
