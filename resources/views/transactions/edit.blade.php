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
            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="control-label">* Date</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ old("date", $transaction->date) }}">
                @if($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                <label for="amount" class="control-label">* Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" id="amount" value="{{ old("amount", number_format($transaction->amount, 2)) }}">
                @if($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label for="category_id" class="control-label">* Category</label>
                <select id="category_id" name="category_id" class="form-control">
                    <option value='0'>Choose</option>
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
                @if($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="control-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ old("description", $transaction->description) }}">
                @if($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('newTag') ? ' has-error' : '' }}">
                <strong>Tags</strong>
                <div class="panel panel-default">
                    <div class="panel-body tag">
                        <label for="newTag" class="control-label"><input class="form-control" type="text" id="newTag" name="newTag" placeholder="Add a new tag here"></label>
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
                @if($errors->has('newTag'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newTag') }}</strong>
                    </span>
                @endif
            </div>
            <input class="btn btn-success btn-lg pull-left" type="submit" value="Save">
            <a href="/" class="btn btn-danger btn-lg pull-right"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
            <br><br>
        </form>
    </div>

    @push('body')
        <script src="/js/transactions.js"></script>
    @endpush

@endsection
