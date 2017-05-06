@extends('layouts.master')

@section('title')
    Expense Report
@endsection

@push('head')
    <link href='/css/report.css' rel='stylesheet'>
@endpush

@section('content')

    <div class="container">

        <form class="form-inline text-center" id="filter" method="get" action="/report">

            @include('errors')
            <br>

            <div class="form-group form-group-sm">
                <label for='startDate'>* Start Date</label>
                <input type='date' name='startDate' class="form-control" id='startDate' value='{{ $startDate }}'>
            </div>
            <div class="form-group form-group-sm">
                <label for='endDate'>* End Date</label>
                <input type='date' name='endDate' class="form-control" id='endDate' value='{{ $endDate }}'>
            </div>



            <input class='btn btn-primary btn-sm' type='submit' value='Filter'>

        </form>

        <h2 class="text-center">Expense Report<br>
        <small>from {{ $startDate }} to {{ $endDate }}</small></h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($sumByCategory as $category => $sum)

                    <tr>
                        <td>{{ $category }} <br><br> Total</td>
                        <td><br><br>{{ '$'.number_format($sum, 2) }}</td>
                    </tr>

                @endforeach

                    <tr>
                        <th>TOTAL</th>
                        <th>{{ '$'.number_format($total, 2) }}</th>
                    </tr>
            </tbody>
        </table>
        <br><br>


    </div>

@endsection
