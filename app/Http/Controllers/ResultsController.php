<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use App\Result;

class ResultsController extends Controller
{
    public function index()
    {
        // TODO: Put these values in a config somewhere
        $firstYear = 2014;
        $lastYear = 2016;

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
        ];

        return view('results.index', $data);
    }
}
