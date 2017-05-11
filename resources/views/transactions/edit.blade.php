@extends('layouts.master')

@section('title')
    Edit transaction
@endsection


@section('content')

    <div class="container">
        <form method="POST" action="/transactions/edit">
            {{ csrf_field() }}
            <h2 class="text-center">Edit transaction</h2>
            <small>* Required fields</small>

            <input type="hidden" name="id" value="{{$transaction->id}}">
            <div class="form-group">
                <label for="date">* Date</label>
                <input type="date" name="date" class="form-control" id="date" placeholder="YYYY-MM-DD" value="{{ old("date", $transaction->date) }}">
            </div>
            <div class="form-group">
                <label for="amount">* Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" id="amount" value="{{ old("amount", number_format($transaction->amount, 2)) }}">
            </div>
            <div class="form-group">
                <label for="category_id">* Category</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categoriesForDropdown as $category_id => $categoryName)
                        <option value="{{ $category_id }}"
                        @if ($category_id == old("category_id"))
                            {{ "SELECTED" }}
                        @elseif (!old("category_id"))
                            {{ ($transaction->category_id == $category_id) ? "SELECTED" : "" }}
                        @else
                            {{ "" }}
                        @endif>
                            {{$categoryName}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ old("description", $transaction->description) }}">
            </div>
            <div class="form-group">
                <strong>Tags</strong>
                <div class="panel panel-default">
                    <div class="panel-body tag">
                        <label for="newTag"><input class="form-control" type="text" id="newTag" name="newTag" placeholder="Add a new tag here"></label>
                        @foreach ($tagsForCheckboxes as $tag_id => $tagName)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="tags[{{ $tag_id }}]"
                                    @if (old("tags"))
                                        {{ array_key_exists($tag_id, old("tags")) ? "CHECKED" : "" }}
                                    @else
                                        {{ (in_array($tagName, $tagsForThisTransaction)) ? "CHECKED" : "" }}
                                    @endif
                                    > {{ $tagName }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('errors')

            <input class="btn btn-success btn-lg pull-left" type="submit" value="Save">
            <a href="/" class="btn btn-danger btn-lg pull-right"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
            <br><br>
        </form>
    </div>

@endsection
