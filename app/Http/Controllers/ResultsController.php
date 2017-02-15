<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Cache;
use App\Result;
use Config;
use JavaScript;
use Storage;

class ResultsController extends Controller
{
    public function index()
    {
        exit('test');
        $chartData = [];

        // Check for cached data
        //$cache = Cache::orderBy('created_at', 'desc')->first();

        if (false) {
            $chartData = unserialize($cache->data);
        }

        // If no data is cached, re-build the chart data
        if (!$chartData || !count($chartData)) {
            $firstYear = Config::get('dopey.firstYear');
            $lastYear = Config::get('dopey.lastYear');

            // Count by year
            for ($i = $firstYear; $i <= $lastYear; $i++) {
                $perfectListByYear[$i] = Result::getPerfectsByYear($i);
                $chartData['countByYear'][] = [(string)$i, count($perfectListByYear[$i])];
            }

            // Count by gender
            $result = Result::countPerfectsByGender();
            $chartData['countByGender'][] = ['Gender','Total'];
            foreach ($result as $row) {
                $chartData['countByGender'][] = [$row->gender, $row->count];
            }

            // Count by age
            $result = Result::countPerfectsByAge();
            //$chartData['countByAge'][] = ['Age','Total'];
            $last = 0;
            foreach ($result as $row) {
                while ($last && $last + 1 !== (int)$row->age) {
                    $chartData['countByAge'][] = [(string)++$last, 0];
                }

                $chartData['countByAge'][] = [(string)$row->age, (int)$row->count];
                $last = (int)$row->age;
            }

            // Count by State
            $result = Result::countPerfectsByState();
            $chartData['countByState'][] = ['State','Total'];
            foreach ($result as $row) {
                $chartData['countByState'][] = [$row->state, $row->count];
            }

            // Count by country
            $result = Result::countPerfectsByCountry();
            $chartData['countByCountry'][] = ['Country','Total'];
            foreach ($result as $row) {
                $chartData['countByCountry'][] = [$row->country, $row->count];
            }

            /*
            $result = Result::countPerfectsByEvent('5k');
            foreach ($result as $row) {
                $chartDataBy5k[$row->{'minutes'}] = $row->count;
            }*/

            // Store the compiled data in the database as a cache
            //$cache = new Cache();
            //$cache->data = serialize($chartData);
            //$cache->save();
        }

        // Make the chart data available to JavaScript
        JavaScript::put($chartData);

        return view('results.index');
    }
}
