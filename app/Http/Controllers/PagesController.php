<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * The homepage
     */
    public function home()
    {
        return view('pages.layout');
    }

    /**
     * The about page
     */
    public function about()
    {

    }

    /**
     * The contact page
     */
    public function contact()
    {

    }
}
