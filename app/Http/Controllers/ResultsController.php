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

        $viewData = $this->getPerfectData();

        // Store the compiled data in the database as a cache
        //$cache = new Cache();
        //$cache->data = serialize($chartData);
        //$cache->save();

        // Make the chart data available to JavaScript
        //JavaScript::put($viewData['chartData']);

        return view('results.'.$mode, $viewData);
    }

    /**
     * 
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
        //$statData['countTotal'] = (int)Result::countTotal('perfect');

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
            ->colors(['#f00'])
            ->responsive(false);

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
            ->colors(['#87ceeb', '#FFC0CB'])
            ->labels($chartLabels)
            ->values($chartValues);

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
            ->colors(['#f00'])
            ->labels($chartLabels)
            ->values($chartValues);








            /*
        // Get data over time (year)
        for ($i = $dopeyFirstYear; $i <= $dopeyLastYear; $i++) {
            // Count for year
            $chartData['countForYear'][] = [(string)$i, (int)Result::countForYear($i, 'perfect')];

            // Count by gender for year
            $result = Result::countForYearByGender($i, 'perfect');
            foreach ($result as $row) {
                $chartData['countForYearByGender'][$i][] = [$row->gender, $row->count];
            }

            // Count by age for year
            $result = Result::countForYearByAge($i, 'perfect');
            $last = 0;
            foreach ($result as $row) {
                while ($last && $last + 1 !== (int)$row->age) {
                    $chartData['countForYearByAge'][$i][] = [(string)++$last, 0];
                }

                $chartData['countForYearByAge'][$i][] = [(string)$row->age, (int)$row->count];
                $last = (int)$row->age;
            }
        }

        // Count for gender (same as counts for latest year)
        $result = Result::countByGender('perfect');
        $chartData['countByGender'][] = ['Gender','Total'];
        foreach ($result as $row) {
            $chartData['countByGender'][] = [$row->gender, $row->count];
        }

        // Count for age (same as counts for latest year)
        $result = Result::countByAge('perfect');
        $last = 0;
        foreach ($result as $row) {
            while ($last && $last + 1 !== (int)$row->age) {
                $chartData['countByAge'][] = [(string)++$last, 0];
            }

            $chartData['countByAge'][] = [(string)$row->age, (int)$row->count];
            $last = (int)$row->age;
        }

        // Count for State
        $result = Result::countByState();
        $chartData['countByState'][] = ['State','Total'];
        foreach ($result as $row) {
            $chartData['countByState'][] = [$row->state, $row->count];
        }

        // Count for country
        $result = Result::countByCountry();
        $chartData['countByCountry'][] = ['Country','Total'];
        foreach ($result as $row) {
            $chartData['countByCountry'][] = [$row->country, $row->count];
        }
    */

        /* List data
        ---------------------------------------------------------------------*/


        return [
            'stats' => $stats,
            'charts' => $charts,
            'lists' => $lists
        ];
    }

    /**
     * 
     */
    private function getOverallData()
    {
        $statData = $chartData = $listData = [];

        return [
            'statData' => $statData,
            'chartData' => $chartData,
            'listData' => $listData
        ];
    }

    /**
     * 
     */
    private function getYearlyData($year = 2014)
    {
        $statData = $chartData = $listData = [];

        return [
            'statData' => $statData,
            'chartData' => $chartData,
            'listData' => $listData
        ];
    }
}
