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

        return view('results.index')->with('years', array_keys($perfects))->with('totals', array_values($perfectCounts));
    }
}
