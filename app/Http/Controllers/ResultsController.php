<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Cache;
use App\Result;
use Charts;
use Config;
use JavaScript;
use Storage;

class ResultsController extends Controller
{
    public function results(Request $request, $mode = 'overall', $type = 'stats')
    {
        // Get Dopey Challenge config values
        $dopeyFirstYear = Config::get('dopey.firstYear');
        $dopeyLastYear = Config::get('dopey.lastYear');

        /* Validate the request parameters
        ---------------------------------------------------------------------*/

        $mode = strtolower($mode);
        $type = strtolower($type);

        // Category must be "overall", "perfect" or a year from 2014 to the latest challenge year
        if (!in_array($mode, ['overall', 'perfect']) && !((int)$mode >= $dopeyFirstYear && (int)$mode <= $dopeyLastYear)) {
            return abort(404);
        }

        // Type must be either "stats", "graphs", or "list"
        if (!in_array($type, ['stats', 'graphs', 'list'])) {
            return abort(404);
        }

        /* Gather the data
        ---------------------------------------------------------------------*/

        $modeFunction = 'get'.((int)$mode > 0 ? 'Yearly' : ucfirst($mode)).'Data';

        $viewData = $this->$modeFunction($mode);

        // Store the compiled data in the database as a cache
        //$cache = new Cache();
        //$cache->data = serialize($chartData);
        //$cache->save();

        //$viewData['mode'] = $mode;
        $viewData['mode'] = ucfirst($mode);
        $viewData['type'] = $type;

        return view('results.'.((int)$mode > 0 ? 'yearly' : $mode), $viewData);
    }

    /**
     * Get data for Perfect Dopeys
     */
    private function getPerfectData()
    {
        // Get Dopey Challenge config values
        $dopeyFirstYear = Config::get('dopey.firstYear');
        $dopeyLastYear = Config::get('dopey.lastYear');

        $stats = $charts = $lists = [];

        /* Stat data
        ---------------------------------------------------------------------*/

        // Count total perfect finishers (same as count for 2017)
        $stats['countTotal'] = (int)Result::countTotal('perfect');

        // Get the percentages of men and women finishers
        $genderResults = Result::countByGender('perfect');
        $stats['percentMen'] = round((int)$genderResults[0]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);
        $stats['percentWomen'] = round((int)$genderResults[1]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);

        // Get average age
        $ageResults = Result::countByAge('perfect');
        $totalAge = 0;
        foreach ($ageResults as $result) {
            $totalAge += ($result->age * $result->count);
        }
        $stats['averageAge'] = round($totalAge / str_replace(',', '', $stats['countTotal']), 2);

        /* Chart data
        ---------------------------------------------------------------------*/

        // Number of Perfect Dopeys by year

        $chartLabels = $chartValues = [];

        for ($i = $dopeyFirstYear; $i <= $dopeyLastYear; $i++) {
            $chartLabels[] = (string)$i;
            $chartValues[] = (int)Result::countForYear($i, 'perfect');
        }

        $charts['countByYear'] = Charts::create('bar')
            ->title('Perfect Dopeys By Year')
            ->elementLabel('Perfect Dopeys')
            ->labels($chartLabels)
            ->values($chartValues)
            ->colors(['#63136E'])
            ->y_axis_title('Number of Perfect Dopeys')
            ->x_axis_title('Year');

        // Number of Perfect Dopeys by gender

        $chartLabels = $chartValues = [];

        $result = Result::countByGender('perfect');
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->gender;
            $chartValues[] = $row->count;
        }

        $charts['countByGender'] = Charts::create('bar')
            ->title('Perfect Dopeys By Gender')
            ->elementLabel('Perfect Dopeys')
            ->colors(['#63136E', '#80C125'])
            ->labels($chartLabels)
            ->values($chartValues)
            ->y_axis_title('Number of Perfect Dopeys')
            ->x_axis_title('Gender');

        // Number of Perfect Dopeys by age

        $chartLabels = $chartValues = [];

        $result = Result::countByAge('perfect');
        $last = 0;
        foreach ($result as $row) {
            while ($last && $last + 1 !== (int)$row->age) {
                $chartLabels[] = (string)++$last;
                $chartValues[] = 0;
            }

            $chartLabels[] = (string)$row->age;
            $chartValues[] = (int)$row->count;
            $last = (int)$row->age;
        }

        $charts['countByAge'] = Charts::create('line')
            ->title('Perfect Dopeys by Age')
            ->elementLabel('Perfect Dopeys')
            ->colors(['#63136E'])
            ->labels($chartLabels)
            ->values($chartValues)
            ->y_axis_title('Number of Perfect Dopeys')
            ->x_axis_title('Age');

        // Number of Perfect Dopeys by race time (in minutes)

        $chartLabels = $chartValues = [];

        foreach(['5k', '10k', 'half', 'full'] as $race) {
            $result = Result::countForRaceByTime($race, 'perfect');
            $last = 0;
            foreach ($result as $row) {
                while ($last && $last + 1 !== (int)$row->minutes) {
                    $chartLabels[$race][] = (string)++$last;
                    $chartValues[$race][] = 0;
                }

                $chartLabels[$race][] = (string)$row->minutes;
                $chartValues[$race][] = (int)$row->count;
                $last = (int)$row->minutes;
            }

            $charts['countByTime-'.$race] = Charts::create('area')
                ->title('Perfect Dopeys by Time For '.ucfirst($race))
                ->elementLabel('Perfect Dopeys')
                ->colors(['#63136E'])
                ->labels($chartLabels[$race])
                ->values($chartValues[$race])
                ->y_axis_title('Number of Perfect Dopeys')
                ->x_axis_title('Average Finish Time in Minutes');
        }

        // Number of Perfect Dopeys by country

        $chartLabels = $chartValues = [];

        $result = Result::countByCountry('perfect');
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->country;
            $chartValues[] = $row->count;
        }

        $charts['countByCountry'] = Charts::create('geo')
            ->title('Perfect Dopeys By Country')
            ->elementLabel('Perfect Dopeys')
            ->colors(['#7E5C8F', '#63136E'])
            ->labels($chartLabels)
            ->values($chartValues);

        /* List data
        ---------------------------------------------------------------------*/

        return [
            'stats' => $stats,
            'charts' => $charts,
            'lists' => $lists
        ];
    }

    /**
     * Get data for overall Dopey participants
     */
    private function getOverallData()
    {
        // Get Dopey Challenge config values
        $dopeyFirstYear = Config::get('dopey.firstYear');
        $dopeyLastYear = Config::get('dopey.lastYear');

        $stats = $charts = $lists = [];

        /* Stat data
        ---------------------------------------------------------------------*/

        // Count total distinct Dopey Challenge finishers
        $stats['countTotal'] = number_format((int)Result::countTotal('overall'));

        // Get the percentages of men and women finishers
        $genderResults = Result::countByGender('overall');
        $stats['percentMen'] = round((int)$genderResults[0]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);
        $stats['percentWomen'] = round((int)$genderResults[1]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);

        // Get average age
        $ageResults = Result::countByAge('overall');
        $totalAge = 0;
        foreach ($ageResults as $result) {
            $totalAge += ($result->age * $result->count);
        }
        $stats['averageAge'] = round($totalAge / str_replace(',', '', $stats['countTotal']), 2);

        /* Chart data
        ---------------------------------------------------------------------*/

        // Number of distinct finishers by year

        $chartLabels = $chartValues = [];

        for ($i = $dopeyFirstYear; $i <= $dopeyLastYear; $i++) {
            $chartLabels[] = (string)$i;
            $chartValues[] = (int)Result::countForYear($i, 'overall');
        }

        $charts['countByYear'] = Charts::create('bar')
            ->title('Dopey Challenge Finishers By Year')
            ->elementLabel('Dopey Challenge Finishers')
            ->labels($chartLabels)
            ->values($chartValues)
            ->colors(['#63136E']);

        // Number of distinct finishers by gender

        $chartLabels = $chartValues = [];

        $result = Result::countByGender('overall');
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->gender;
            $chartValues[] = $row->count;
        }

        $charts['countByGender'] = Charts::create('bar')
            ->title('Distinct Finishers By Gender')
            ->elementLabel('Finishers')
            ->colors(['#63136E', '#80C125'])
            ->labels($chartLabels)
            ->values($chartValues);

        // Number of distinct Dopeys by age

        $chartLabels = $chartValues = [];

        $result = Result::countByAge('overall');
        $last = 0;
        foreach ($result as $row) {
            while ($last && $last + 1 !== (int)$row->age) {
                $chartLabels[] = (string)++$last;
                $chartValues[] = 0;
            }

            $chartLabels[] = (string)$row->age;
            $chartValues[] = (int)$row->count;
            $last = (int)$row->age;
        }

        $charts['countByAge'] = Charts::create('line')
            ->title('Dopeys by Age')
            ->elementLabel('Dopeys')
            ->colors(['#63136E'])
            ->labels($chartLabels)
            ->values($chartValues);

        // Number of Finishers by race time (in minutes)

        $chartLabels = $chartValues = [];

        foreach(['5k', '10k', 'half', 'full'] as $race) {
            $result = Result::countForRaceByTime($race, 'overall');
            $last = 0;
            foreach ($result as $row) {
                while ($last && $last + 1 !== (int)$row->minutes) {
                    $chartLabels[$race][] = (string)++$last;
                    $chartValues[$race][] = 0;
                }

                $chartLabels[$race][] = (string)$row->minutes;
                $chartValues[$race][] = (int)$row->count;
                $last = (int)$row->minutes;
            }

            $charts['countByTime-'.$race] = Charts::create('area')
                ->title('Finishers by Time For '.ucfirst($race))
                ->elementLabel('Finishers')
                ->colors(['#63136E'])
                ->labels($chartLabels[$race])
                ->values($chartValues[$race])
                ->y_axis_title('Number of Finishers')
                ->x_axis_title('Average Finish Time in Minutes');
        }

        // Number of finishers by country

        $chartLabels = $chartValues = [];

        $result = Result::countByCountry('overall');
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->country;
            $chartValues[] = $row->count;
        }

        $charts['countByCountry'] = Charts::create('geo')
            ->title('Finishers By Country')
            ->elementLabel('Finishers')
            ->colors(['#7E5C8F', '#63136E'])
            ->labels($chartLabels)
            ->values($chartValues);

        return [
            'stats' => $stats,
            'charts' => $charts,
            'lists' => $lists
        ];
    }

    /**
     * Get data for one year at a time
     */
    private function getYearlyData($year = 2014)
    {
        // Get Dopey Challenge config values
        $dopeyFirstYear = Config::get('dopey.firstYear');
        $dopeyLastYear = Config::get('dopey.lastYear');

        $stats = $charts = $lists = [];

        /* Stat data
        ---------------------------------------------------------------------*/

        // Count total distinct Dopey Challenge finishers
        $stats['countTotal'] = number_format((int)Result::countForYear($year));

        // Get the percentages of men and women finishers
        $genderResults = Result::countForYearByGender($year);
        $stats['percentMen'] = round((int)$genderResults[0]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);
        $stats['percentWomen'] = round((int)$genderResults[1]->count / str_replace(',', '', $stats['countTotal']) * 100, 2);

        // Get average age
        $ageResults = Result::countForYearByAge($year);
        $totalAge = 0;
        foreach ($ageResults as $result) {
            $totalAge += ($result->age * $result->count);
        }
        $stats['averageAge'] = round($totalAge / str_replace(',', '', $stats['countTotal']), 2);

        /* Chart data
        ---------------------------------------------------------------------*/

        // Number of yearly finishers by gender

        $chartLabels = $chartValues = [];

        $result = Result::countForYearByGender($year);
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->gender;
            $chartValues[] = $row->count;
        }

        $charts['countByGender'] = Charts::create('bar')
            ->title($year.' Dopeys By Gender')
            ->elementLabel('Dopeys')
            ->colors(['#63136E', '#80C125'])
            ->labels($chartLabels)
            ->values($chartValues);

        // Number of yearly Dopeys by age

        $chartLabels = $chartValues = [];

        $result = Result::countForYearByAge($year);
        $last = 0;
        foreach ($result as $row) {
            while ($last && $last + 1 !== (int)$row->age) {
                $chartLabels[] = (string)++$last;
                $chartValues[] = 0;
            }

            $chartLabels[] = (string)$row->age;
            $chartValues[] = (int)$row->count;
            $last = (int)$row->age;
        }

        $charts['countByAge'] = Charts::create('line')
            ->title('Dopeys by Age in ' . $year)
            ->elementLabel('Dopeys')
            ->colors(['#63136E'])
            ->labels($chartLabels)
            ->values($chartValues);

        // Number of Finishers by race time (in minutes)

        $chartLabels = $chartValues = [];

        foreach(['5k', '10k', 'half', 'full'] as $race) {
            $result = Result::countForYearAndRaceByTime($year, $race);
            $last = 0;
            foreach ($result as $row) {
                while ($last && $last + 1 !== (int)$row->minutes) {
                    $chartLabels[$race][] = (string)++$last;
                    $chartValues[$race][] = 0;
                }

                $chartLabels[$race][] = (string)$row->minutes;
                $chartValues[$race][] = (int)$row->count;
                $last = (int)$row->minutes;
            }

            $charts['countByTime-'.$race] = Charts::create('area')
                ->title('Finishers by Time For '.ucfirst($race))
                ->elementLabel('Finishers')
                ->colors(['#63136E'])
                ->labels($chartLabels[$race])
                ->values($chartValues[$race])
                ->y_axis_title('Number of Finishers')
                ->x_axis_title('Average Finish Time in Minutes');
        }

        // Number of finishers by country

        $chartLabels = $chartValues = [];

        $result = Result::countForYearByCountry($year, 'overall');
        foreach ($result as $row) {
            $chartLabels[] = (string)$row->country;
            $chartValues[] = $row->count;
        }

        $charts['countByCountry'] = Charts::create('geo')
            ->title('Finishers By Country')
            ->elementLabel('Finishers')
            ->colors(['#7E5C8F', '#63136E'])
            ->labels($chartLabels)
            ->values($chartValues);

        return [
            'stats' => $stats,
            'charts' => $charts,
            'lists' => $lists,
            'year' => $year
        ];
    }
}
