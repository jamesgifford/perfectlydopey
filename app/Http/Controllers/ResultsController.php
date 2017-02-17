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
            ->colors(['#63136E']);

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
            ->colors(['#63136E'])
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

        /* Chart data
        ---------------------------------------------------------------------*/

        

        return [
            'stats' => $stats,
            'charts' => $charts,
            'lists' => $lists
        ];
    }
}
