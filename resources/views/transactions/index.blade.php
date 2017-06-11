@extends('layouts.master')

@section('title')
    Transactions
@endsection

@section('content')

    <div class="container">

        @include('modals/deleteTransaction')

        @if(!$isRequest && $transactions->count() == 0)
            <div class="jumbotron">
                <p class="text-center">У вас немає жодної транзакції; додайте одну<a href="/transactions/new">тут</a>?</p>
            </div>
        @else
            <div>
                <a href="/transactions/new" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Нова транзакція</a>
                <a href="#transactionFilter" class="btn btn-primary pull-right" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="transactionFilter">Фільтр транзакцій</a>
            </div>

            @include('transactions/filter')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Дата/Категорія</th>
                        <th>Сума</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr id="row_{{ $transaction->id }}" class="transactionRow" data-href="/transactions/edit/{{ $transaction->id }}">
                            <td>{{ $transaction->date }}<br><strong class="category">{{ $transaction->category->name }}</strong><br><small>{{ $transaction->description }}</small>
                                <br><span class="glyphicon glyphicon-tags tags"></span>
                                @foreach ($transaction->tags as $tag)
                                    <small class="tags">&nbsp;{{ $tag->name }}</small>
                                @endforeach
                            </td>
                            <td>
                                <a class="delete-icon" href="#deleteTransaction" data-toggle="modal" data-id="{{ $transaction->id }}" data-date="{{ $transaction->date }}" data-category="{{ $transaction->category->name }}" data-amount="{{ $transaction->amount }}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                <br><br><br>{{number_format($transaction->amount, 2)}}&nbsp;грн.
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br>
        @endif
    </div>

    @push('body')
        <script src="/js/transactions.js"></script>
    @endpush

@endsection
