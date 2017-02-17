<?php

// Results pages
Route::get('/results/{category?}/{type?}', 'ResultsController@results')->name('results');

// Homepage
Route::get('/', 'PagesController@home')->name('home');
