@extends('layouts.default')

@section('content')

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Perfectly Dopey</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
            <div class="navbar-title" style="display: none;">
                <div>Perfect Dopeys</div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h2>Perfect Dopeys By Year</h2>
                <div class="chart">
                    <div id="perfectYear" class="ct-chart ct-sm-golden-section ct-md-octave ct-lg-octave"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h2>Perfect Dopeys By Gender</h2>
                <div class="chart">
                    <div id="perfectGender" class="ct-chart ct-sm-golden-section ct-md-octave ct-lg-octave"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h2>Perfect Dopeys By Age</h2>
                <div class="chart">
                    <div id="perfectAge" class="ct-chart ct-sm-golden-section ct-md-golden-section ct-lg-golden-section"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h2>Perfect Dopeys By State</h2>
                <div class="chart">
                    <div id="perfectState" class="ct-chart ct-sm-golden-section ct-md-golden-section ct-lg-golden-section"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h2>Perfect Dopeys By Country</h2>
                <div class="chart">
                    <div id="perfectCountry" class="ct-chart ct-sm-golden-section ct-md-golden-section ct-lg-golden-section"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
