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
        // TODO: get data for perfect dopeys and pass it to view in way that works with chart.js
        $perfects = Result::getPerfects();
        $totalsByYear = Result::getTotalsByYear();
        //$all = Result::all();

        //print_r($all->lists('year'));
        //exit();

        return view('results.index')->with('years', [2014, 2015, 2016])->with('totals', [6145, 6245, 6687]);
    }
}
