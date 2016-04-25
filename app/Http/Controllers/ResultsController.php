<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cache;
use App\Result;
use Config;
use Storage;

class ResultsController extends Controller
{
    public function index()
    {
        // Check data cache first
        $cache = Cache::orderBy('created_at', 'desc')->first();

        if ($cache) {
            $data = unserialize($cache->data);

            return view('results.index', $data);
        }

        $firstYear = Config::get('dopey.firstYear');
        $lastYear = Config::get('dopey.lastYear');

        for ($i = $firstYear; $i <= $lastYear; $i++) {
            $perfects[$i] = Result::getPerfectsByYear($i);
            $perfectCounts[$i] = count($perfects[$i]);
        }

        $result = Result::countPerfectsByGender();
        foreach ($result as $row) {
            $perfectsByGender[$row->gender] = $row->count;
        }

        $result = Result::countPerfectsByAge();
        foreach ($result as $row) {
            $perfectsByAge[$row->age] = $row->count;
        }

        $result = Result::countPerfectsByState();
        foreach ($result as $row) {
            $perfectsByState[$row->state] = $row->count;
        }

        $result = Result::countPerfectsByCountry();
        foreach ($result as $row) {
            $perfectsByCountry[$row->country] = $row->count;
        }

        $result = Result::countPerfectsByEvent('5k');
        foreach ($result as $row) {
            $perfectsBy5k[$row->{'minutes'}] = $row->count;
        }

        $data = [
            'perfect' => [
                'countByYear' => [
                    'labels' => array_keys($perfects),
                    'series' => array_values($perfectCounts),
                ],
                'countByGender' => [
                    'labels' => array_keys($perfectsByGender),
                    'series' => array_values($perfectsByGender),
                ],
                'countByAge' => [
                    'labels' => array_keys($perfectsByAge),
                    'series' => array_values($perfectsByAge),
                ],
                'countByState' => [
                    'labels' => array_keys($perfectsByState),
                    'series' => array_values($perfectsByState),
                ],
                'countByCountry' => [
                    'labels' => array_keys($perfectsByCountry),
                    'series' => array_values($perfectsByCountry),
                ],
                'countByEvent' => [
                    'labels' => '',
                    '5k_series' => '',
                    '10k_series' => '',
                    'half_series' => '',
                    'full_series' => '',
                ]
            ],
        ];

        // Store the compiled data in the database as a cache
        $cache = new Cache();
        $cache->data = serialize($data);
        $cache->save();

        return view('results.index', $data);
    }
}
