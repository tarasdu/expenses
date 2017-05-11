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
            <h2 class="text-center">Add new transaction</h2>
            <small>* Required fields</small>

            <div class="form-group">
                <label for='date'>* Date</label>
                <input type='date' name='date' class="form-control" id='date' value='{{ old('date', date('Y-m-d')) }}'>
            </div>
            <div class="form-group">
                <label for='amount'>* Amount</label>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type='amount' step='0.01' name='amount' class="form-control" id='amount' value='{{ old('amount') }}'>
                </div>
            </div>
            <div class="form-group">
                <label for='category_id'>* Category:</label>
                <select id='category_id' name='category_id' class="form-control">
                    @foreach($categoriesForDropdown as $category_id => $categoryName)
                        <option value='{{ $category_id }}' @if (old('category_id') == $category_id) {{ 'SELECTED' }} @endif>
                            {{$categoryName}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for='description'>Description</label>
                <input type='description' name='description' class="form-control" id='description' value='{{ old('description') }}'>
            </div>
            {{--
            <div class="form-group">
                <label for='tags'>Tags:</label>
                <select id='tags' name='tags[]' class="form-control" multiple>
                    @foreach($tagsForCheckboxes as $tag_id => $tagName)
                        <option value='{{ $tag_id }}'
                            @if (old('tags'))
                                {{ (in_array($tag_id, old('tags'))) ? 'SELECTED' : '' }}
                            @endif>
                            {{$tagName}}
                        </option>
                    @endforeach
                </select>
            </div>
            --}}
            <div class="form-group">
                <strong>Tags</strong>
                <div class="panel panel-default">
                    <div class="panel-body tag">
                        <label for="newTag"><input class="form-control" type="text" id="newTag" name="newTag" placeholder="Add a new tag here"></label>
                        @foreach ($tagsForCheckboxes as $tag_id => $tagName)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="tags[{{ $tag_id }}]"
                                    @if (old('tags'))
                                        {{ array_key_exists($tag_id, old('tags')) ? 'checked="checked"' : '' }}
                                    @endif
                                    > {{ $tagName }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Extracted error code to its own view file --}}
            @include('errors')

            <input class='btn btn-success btn-lg pull-left' type='submit' value='Add transaction'>
            <a href="/" class="btn btn-danger btn-lg pull-right"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
            <br><br>

        </form>
    </div>

@endsection
