@extends('layouts.master')

@section('title')
    Edit transaction:
@endsection

@push('head')
    <link href='/css/transaction.css' rel='stylesheet'>
@endpush

@section('content')

    <div class='container'>

        <form method='POST' action='/transactions/edit'>
            {{ csrf_field() }}
            <h2>Edit transaction</h2>
            <small>* Required fields</small>

            <input type='hidden' name='id' value='{{$transaction->id}}'>
            <div class="form-group">
                <label for='date'>* Date</label>
                <input type='date' name='date' class="form-control" id='date' value='{{ old('date', $transaction->date) }}'>
            </div>
            <div class="form-group">
                <label for='amount'>* Amount</label>
                <input type='number' step='0.01' name='amount' class="form-control" id='amount' value='{{ old('amount', number_format($transaction->amount, 2)) }}'>
            </div>
            <div class="form-group">
                <label for='category'>* Category</label>
                <input type='text' name='category' class="form-control" id='category' value='{{ old('category', $transaction->category) }}'>
            </div>
            <div class="form-group">
                <label for='description'>* Description</label>
                <input type='text' name='description' class="form-control" id='description' value='{{ old('description', $transaction->description) }}'>
            </div>
            {{-- Extracted error code to its own view file --}}
            @include('errors')

            <input class='btn btn-success btn-lg' type='submit' value='Save changes'>
            <a href="/" class="btn btn-danger btn-lg">Cancel</a>
            <br><br>

        </form>
    </div>

@endsection
