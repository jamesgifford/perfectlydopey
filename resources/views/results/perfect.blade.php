@extends('results.layout')

@section('content')

    <h2 id="totals">Totals</h2>

        <div class="container category">
            <div class="row stat">
                <div class="title">Total Perfect Dopeys</div>
                <div class="number">{!! $stats['countTotal'] !!}</div>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByYear']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-totals -->

        <h2 id="gender">Gender</h2>

        <div class="container category">
            <div class="row stat">
                <div class="title">Percentage of Perfectly Dopey Men</div>
                <div class="number">{!! $stats['percentMen'] !!}%</div>
            </div>
            <div class="row stat">
                <div class="title">Percentage of Perfectly Dopey Women</div>
                <div class="number">{!! $stats['percentWomen'] !!}%</div>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByGender']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-gender -->

        <h2 id="age">Age</h2>

        <div class="container category">
            <div class="row stat">
                <div class="title">Average Age</div>
                <div class="number">{!! $stats['averageAge'] !!}</div>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByAge']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-age -->

        <h2 id="time">Time</h2>

        <div class="container category">
            <div class="row chart">
                <center>
                    {!! $charts['countByTime-5k']->render() !!}
                </center>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByTime-10k']->render() !!}
                </center>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByTime-half']->render() !!}
                </center>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByTime-full']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-time -->

        <h2 id="location">Location</h2>

        <div class="container category">
            <div class="row stat">
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByCountry']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-age -->

@endsection