@extends('layouts.master')

@section('title')
    Add new transaction:
@endsection

@push('head')
    <link href='/css/transaction.css' rel='stylesheet'>
@endpush

@section('content')

    <div class='container'>

        <form method='POST' action='/transactions/new'>
            {{ csrf_field() }}
            <h2>Add new transaction</h2>
            <small>* Required fields</small>

            <div class="form-group">
                <label for='date'>* Date</label>
                <input type='date' name='date' class="form-control" id='date' value='{{ old('date', date('Y-m-d')) }}'>
            </div>
            <div class="form-group">
                <label for='amount'>* Amount</label>
                <input type='amount' step='0.01' name='amount' class="form-control" id='amount' value='{{ old('amount') }}'>
            </div>
            <div class="form-group">
                <label for='category_id'>* Category:</label>
                <select id='category_id' name='category_id' class="form-control">
                    @foreach($categoriesForDropdown as $category_id => $categoryName)
                        <option value='{{ $category_id }}'>
                            {{$categoryName}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for='description'>Description</label>
                <input type='description' name='description' class="form-control" id='description' value='{{ old('description') }}'>
            </div>
            {{-- Extracted error code to its own view file --}}
            @include('errors')

            <input class='btn btn-success btn-lg' type='submit' value='Add transaction'>
            <a href="/" class="btn btn-danger btn-lg">Cancel</a>
            <br><br>

        </form>
    </div>

@endsection
