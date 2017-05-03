@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="transactionsContainer">

        <div class="container">

            <div id="deleteFromIndex" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <p class="text-center">Delete transaction?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="/transactions/delete">
                                <input type="submit" class="btn btn-primary" value="Yes">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <form>
                        </div>
                    </div>

                </div>
            </div>

            @if(count($transactions) == 0)
                <div class="jumbotron">
                    <p class="text-center">You don't have any transactions yet; would you like to <a href='/transactions/new'>add one</a>?</p>
                </div>
            @else
                <div>
                    <a href="/transactions/new" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Transaction</a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date/Category</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactions as $transaction)
                            <a href="#">
                            <tr class='row_{{ $transaction->id }}' data-href='/transactions/edit/{{ $transaction->id }}'>
                                <td class='col1'>{{ $transaction->date }}<br>{{ $transaction->category->name }}<br><small>{{ $transaction->description }}</small></td>
                                <td class='col2'>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <br><br>${{number_format($transaction->amount, 2)}}
                                </td>



                            </tr>
                            </a>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
            @endif
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
