@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="transactionsContainer">

        <div class="container">

            @include('modals/deleteTransaction')

            @if(count($transactions) == 0)
                <div class="jumbotron">
                    <p class="text-center">You don't have any transactions yet; would you like to <a href='/transactions/new'>add one</a>?</p>
                </div>
            @else
                <div>
                    <a href="/transactions/new" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Transaction</a>
                    <a href="#transactionFilter" class="btn btn-primary pull-right" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="transactionFilter">Filter Transactions</a>
                </div>

                <div class="collapse" id="transactionFilter">
                    <br>
                    <div class="well">
                        <p>Here will be filter options</p>
                    </div>
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
                            <tr id='row_{{ $transaction->id }}' class='transactionRow' data-href='/transactions/edit/{{ $transaction->id }}'>
                                <td>{{ $transaction->date }}<br><strong class="category">{{ $transaction->category->name }}</strong><br><small>{{ $transaction->description }}</small>
                                    <br><span class="glyphicon glyphicon-tags tags"></span>
                                    @foreach ($transaction->tags as $tag)
                                        <small class="tags">&nbsp;{{ $tag->name }}</small>
                                    @endforeach
                                </td>
                                <td class='col2'>
                                    <a class="delete-icon" href="#deleteTransaction" data-toggle="modal" data-id="{{ $transaction->id }}" data-date="{{ $transaction->date }}" data-category="{{ $transaction->category->name }}" data-amount="{{ $transaction->amount }}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <br><br><br>&#36;{{number_format($transaction->amount, 2)}}
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

            $('#deleteTransaction').on('show.bs.modal', function (event) {

                var trigger = $(event.relatedTarget);
                var transaction_id = trigger.data('id');
                var date = trigger.data('date');
                var category_name = trigger.data('category');
                var amount = trigger.data('amount');
                console.log(transaction_id, category_name, amount);

                $('#deleteTransaction .date').text(date);

                $('#deleteTransaction .category').text(category_name);
                $('#deleteTransaction .amount').text('$'+amount);

                $('.transactionId').attr('value', transaction_id);

            });

        </script>
    @endpush

@endsection
