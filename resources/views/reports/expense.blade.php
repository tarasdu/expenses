@extends('layouts.master')

@section('title')
    Expense Report
@endsection

@section('content')

    <div class="container">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($sumByCategory as $category => $sum)

                    <tr>
                        <td>{{ $category }}</td>
                        <td>{{ $sum }}</td>
                    </tr>

                @endforeach

                    <tr>
                        <th>Total</th>
                        <th>{{ $total }}</th>
                    </tr>
            </tbody>
        </table>
        <br><br>


    </div>

@endsection
