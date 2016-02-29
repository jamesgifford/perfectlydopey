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
        $perfects = Result::getPerfect();

        print_r($perfects);
    }
}
