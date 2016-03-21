<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Result;
use Config;
use Storage;

class ResultsController extends Controller
{
    public function index()
    {
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

        $result = Result::countPerfectsByEvent('full');
        foreach ($result as $row) {
            $perfectsBy5k[$row->{'minutes'}] = $row->count;
        }

        $data = [
            'perfectsByYear' => [
                'year' => array_keys($perfects),
                'count' => array_values($perfectCounts),
            ],
            'perfectsByGender' => [
                'gender' => array_keys($perfectsByGender),
                'count' => array_values($perfectsByGender),
            ],
            'perfectsByAge' => [
                'age' => array_keys($perfectsByAge),
                'count' => array_values($perfectsByAge),
            ],
            'perfectsByState' => [
                'state' => array_keys($perfectsByState),
                'count' => array_values($perfectsByState),
            ],
            'perfectsByCountry' => [
                'country' => array_keys($perfectsByCountry),
                'count' => array_values($perfectsByCountry),
            ],
        ];

        return view('results.index', $data);
    }
}
