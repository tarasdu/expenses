@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="transactionsContainer">

        <div class="container">
            <div>
                <a href="#" class="btn btn-default">New Transaction</a>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                <tbody>

                    @foreach ($transactions as $transaction)
                        <tr class='row_{{ $transaction->id }}'>
                            <td class='col1'>{{ $transaction->date }}</td>
                            <td class='col2'>$ {{ $transaction->amount }}</td>
                            <td class='col3'>{{ $transaction->category }}</td>
                            <td class='col4'><a id="{{ $transaction->id }}" href='#'class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp;<a href='#' class="glyphicon glyphicon-trash"></a></td>
                        </tr>
                        <tr class='tags'>
                            <td colspan="4" class="small">&nbsp;&nbsp;<span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>

    </div>

    @push('body')
        <script>
            $("a.glyphicon-edit").click(function() {
                var transaction_id = '.row_' + $(this).attr( 'id' );
                console.log(transaction_id);
                var query_date = transaction_id + ' .col1';
                var value_date = $(query_date).text();
                var new_date_field = '<td><input type="date" value="' + value_date + '"></input></td>'
                $(query_date).replaceWith(new_date_field);
                console.log(value);






            });
        </script>
    @endpush

@endsection
