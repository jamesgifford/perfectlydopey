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
        $fileName = 'dopey_results_'.$year.'.csv';
        $filePath = storage_path('app/results/'.$fileName);

        $this->info('Importing Dopey Challenge results for ' . $year . '...');

        if (!file_exists($filePath)) {
            $this->error('Could not find results file');
            return;
        }

        try {
            $fileHandle = fopen($filePath, 'r');
        }
        catch (\ErrorException $e) {
            $this->error('Could not open results file');
            return;
        }

        $insertCount = $duplicateCount = 0;
        $states = Config::get('location.states');
        $countries = Config::get('location.countries');

        // Get one line of the csv file at a time
        while (($data = fgetcsv($fileHandle, 1000, ',')) !== false) {
            $name = explode(',', $data[0]);
            $lastName = trim(array_shift($name));
            $firstName = trim(array_pop($name));

            $location = explode(',', $data[7]);
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

            $resultData = [
                'year'          => $year,
                'full_name'     => $data[0],
                'first_name'    => $firstName,
                'last_name'     => $lastName,
                'age'           => $data[1],
                'gender'        => $data[2],
                '5k_time'       => $this->formatTime($data[3]),
                '10k_time'      => $this->formatTime($data[4]),
                'half_time'     => $this->formatTime($data[5]),
                'full_time'     => $this->formatTime($data[6]),
                'location'      => $data[7],
                'city'          => $city,
                'state'         => $state,
                'country'       => $country
            ];

            foreach(['original', 'modified'] as $type) {
                $result = new Result($type);
                foreach ($resultData as $field => $data) {
                    $result->{$field} = $data;
                }

                // Look for whether the this runner's data already exists for a prior year
                $existingRunner = Result::isExistingRunner($result);

                // Set this runner's runner_id to an existing runner if present, or else the next value in the database
                $result->runner_id = $existingRunner ? $existingRunner->runner_id : Result::nextRunnerID();

                try {
                    $result->save();
                    $insertCount++;
                    $this->info($type . ' added: ' . $result->full_name . ' - ' . $result->age . ' - ' . $result->location);
                } catch (\Illuminate\Database\QueryException $e) {
                    $duplicateCount++;
                    $this->line($type . ' duplicate: ' . $result->full_name . ' - ' . $result->age . ' - ' . $result->location);
                    continue;
                }
            }
        }

        $this->comment(($insertCount + $duplicateCount) / 2 . ' results found');
        $this->comment($insertCount / 2 . ' results imported');
        $this->comment($duplicateCount / 2 . ' duplicate results skipped');

        fclose($fileHandle);
    }

    /**
     * Format time values from the dataset with this pattern: HH:MM:SS
     * @param   string  $data   the time value
     * @return  string  the formatted time value
     */
    protected function formatTime($data)
    {
        $originalData = $data;
        $array = array_pad(explode(':', $data), -3, 0);

        if (!$array) {
            return strtoupper($originalData);
        }

        array_walk($array, function(&$value, &$key) {
            $value = (string)str_pad($value, 2, '0', STR_PAD_LEFT);
        });

        return implode(':', $array);
    }
}
