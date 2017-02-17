@extends('results.layout')

@section('content')

    <h2 id="totals">Totals</h2>

        <div class="container category">
            <div class="row stat">
                <div class="title">Total Dopey Finishers This Year</div>
                <div class="number">{!! $stats['countTotal'] !!}</div>
            </div>
            <div class="row chart">
            </div>
        </div> <!-- /#category-totals -->

        <h2 id="gender">Gender</h2>

        <div class="container category">
            <div class="row chart">
            </div>
        </div> <!-- /#category-gender -->

        <h2 id="age">Age</h2>

        <div class="container category">
            <div class="row chart">
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