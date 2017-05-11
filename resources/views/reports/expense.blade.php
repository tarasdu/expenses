@extends('layouts.master')

@section('title')
    Expense Report
@endsection


@section('content')

    <div class="container">
        <form class="form-inline text-center" id="filter" method="GET" action="/report">

            @include('errors')

            <br>
            <div class="form-group form-group">
                <label for="startDate">* Start Date</label>
                <input type="date" name="startDate" class="form-control" id="startDate" placeholder="YYYY-MM-DD" value="{{ $startDate }}">
            </div>
            <div class="form-group form-group">
                <label for="endDate">* End Date</label>
                <input type="date" name="endDate" class="form-control" id="endDate" placeholder="YYYY-MM-DD" value="{{ $endDate }}">
            </div>
            <input class='btn btn-primary' type='submit' value='Filter'>
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
                        <td><strong class="category">{{ $category }}</strong> <br><br> Total</td>
                        <td><br><br>&#36;{{ number_format($sum, 2) }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <th>&#36;{{ number_format($total, 2) }}</th>
                    </tr>
            </tbody>
        </table>
        <br><br>
    </div>

@endsection
