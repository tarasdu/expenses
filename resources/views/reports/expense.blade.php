@extends('layouts.master')

@section('title')
    Expense Report
@endsection


@section('content')

    <div class="container">
        <form class="form-inline text-center" id="filter" method="GET" action="/report">
            <h2>Expense Report</h2>
            <p class="small">* Required fields</p>

            <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                <label for="startDate" class="control-label">* Start Date<br></label>
                <input type="date" name="startDate" class="form-control" id="startDate" value="{{ $startDate }}">
            </div>

            <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                <label for="endDate" class="control-label">* End Date</label>
                <input type="date" name="endDate" class="form-control" id="endDate" value="{{ $endDate }}">
            </div>
            <input class='btn btn-primary' type='submit' value='Filter'>

            @if($errors->any())
                <span class="help-block">
                    <strong class="error">{{ $errors->first() }}</strong>
                </span>
            @endif

        </form>



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

    @push('body')
        <script src="/js/transactions.js"></script>
    @endpush

@endsection
