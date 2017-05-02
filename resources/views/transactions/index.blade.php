@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="transactionsContainer">

        <div class="container">
            <div>
                <a href="/transactions/new" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Transaction</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date/Category</th>
                        <th>Amount</th>


                <tbody>

                    @foreach ($transactions as $transaction)
                        <a href="#">
                        <tr class='row_{{ $transaction->id }}' data-href='/transactions/edit/{{ $transaction->id }}'>
                            <td class='col1'>{{ $transaction->date }}<br>{{ $transaction->category }}<br><small>{{ $transaction->description }}</small></td>
                            <td class='col2'><br><br>${{number_format($transaction->amount, 2)}}</td>


                        </tr>
                        </a>

                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>

    </div>

    @push('body')
        <script>
            $("tr").click(function() {

                /*
                var transaction_id = '.' + $(this).attr( 'class' ) + ' td';
                console.log(transaction_id);
                $(transaction_id).css("color", "red");

                console.log(transaction_id);
                var query_date = transaction_id + ' .col1';
                var value_date = $(query_date).text();
                var new_date_field = '<td><input type="date" value="' + value_date + '"></input></td>'
                $(query_date).replaceWith(new_date_field);
                console.log(value);*/

                window.location = $(this).data("href");





            });
        </script>
    @endpush

@endsection
