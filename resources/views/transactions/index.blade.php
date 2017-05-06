@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="transactionsContainer">

        <div class="container">

            <div id="deleteFromIndex" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                    <!-- Modal -->
                    <div class="modal-content">

                        <div class="modal-body">
                            <p class="text-center">Delete transaction?</p>
                        </div>
                        <div class="modal-footer">
                            <form class="delete-modal" method="POST" action="/transactions/delete">
                                {{ csrf_field() }}
                                <input class="transactionId" type='hidden' name='id'>
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
                            <tr class='transactionRow' data-href='/transactions/edit/{{ $transaction->id }}'>
                                <td class='col1'>{{ $transaction->date }}<br>{{ $transaction->category->name }}<br><small>{{ $transaction->description }}</small></td>
                                <td class='col2'>
                                    <a class="delete-icon" href="#deleteFromIndex" data-toggle="modal" data-transaction="{{ $transaction->id }}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <br><br>${{number_format($transaction->amount, 2)}}
                                </td>
                            </tr>
                        </a>
                        @endforeach
                    </tbody>
                </table>
                <br><br>
            @endif
        </div>

    </div>

    @push('body')
        <script>

            $(".transactionRow").click(function(event) {

                var target = $(event.target);

                if (!target.is(".glyphicon-trash")) {
                    window.location = $(this).data("href");
                }

            });

            $('#deleteFromIndex').on('show.bs.modal', function (event) {

                var trigger = $(event.relatedTarget);
                var transaction_id = trigger.data('transaction');

                $('.transactionId').attr('value', transaction_id);

            });

        </script>
    @endpush

@endsection
