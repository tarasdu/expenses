@extends('layouts.master')

@section('title')
    Edit transaction:
@endsection

@push('head')
    <link href='/css/transaction.css' rel='stylesheet'>
@endpush

@section('content')

    <div class='container'>

        <div id="delete" class="modal fade" role="dialog">
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
                <label for='category_id'>* Category:</label>
                <select id='category_id' name='category_id' class="form-control">
                    @foreach($categoriesForDropdown as $category_id => $categoryName)
                        <option value='{{ $category_id }}' {{ ($transaction->category_id == $category_id) ? 'SELECTED' : '' }}>
                            {{$categoryName}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for='description'>* Description</label>
                <input type='text' name='description' class="form-control" id='description' value='{{ old('description', $transaction->description) }}'>
            </div>
            {{-- Extracted error code to its own view file --}}
            @include('errors')

            <input class='btn btn-success btn-lg' type='submit' value='Save'>
            <a href="/" class="btn btn-info btn-lg">Cancel</a>
            <button type="button" class="btn btn-danger btn-lg pull-right" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
            <br><br>

        </form>
    </div>

@endsection
