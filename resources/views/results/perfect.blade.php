@extends('results.layout')

@section('content')

    <h2 id="totals">Totals</h2>

        <div class="container category">
            <div class="row stat">
                <div class="title">Total Current Perfect Dopeys</div>
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
                <div class="title">Percentage of Perfect Dopeys Who Are Men</div>
                <div class="number">59.5%</div>
            </div>
            <div class="row stat">
                <div class="title">Percentage of Perfect Dopeys Who Are Women</div>
                <div class="number">40.5%</div>
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
                <div class="number">44</div>
            </div>
            <div class="row chart">
                <center>
                    {!! $charts['countByAge']->render() !!}
                </center>
            </div>
        </div> <!-- /#category-age -->

        <h2 id="pace">Pace</h2>

        <div class="container category">
            <div class="row chart">
            </div>
        </div> <!-- /#category-pace -->

        <h2 id="location">Location</h2>

        <div class="container category">
            <div class="row chart">
            </div>
        </div> <!-- /#category-location -->

@endsection