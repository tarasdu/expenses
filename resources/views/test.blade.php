@extends('layouts.master')

@section('title')
    Test
@endsection

@push('head')
    <style>

        .active {
            background-color: lightgrey;
        }
        .panel-body {
            padding: 0 10px;
            max-height: 105px;
            overflow: scroll;
        }

    </style>
@endpush


@section('content')



        <div class="container">

            <div>
                <a href="#Filter" class="btn btn-primary" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="transactionFilter">Filter Transactions</a>
            </div>

            <div class="collapse" id="Filter">
                <br>
                <form method="get" action="/pract/link">
                <div class="well">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong for='startDate'>Start Date</strong>
                                <input type='date' name='startDate' class="form-control" id='startDate' value='{{ old('date')}}'>
                            </div>
                            <div class="form-group">
                                <strong for='endDate'>End Date</strong>
                                <input type='date' name='endDate' class="form-control" id='endDate' value='{{ old('date')}}'>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Category&nbsp;&nbsp;</strong><label for="allcategory"><input id="allcategory" type="checkbox" checked="checked">&nbsp;All</label>
                                <div class="panel panel-default">
                                    <div class="panel-body cat">
                                        @foreach ($categories as $category)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="categories[{{ $category->id }}]" checked="checked"> {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Tags&nbsp;&nbsp;</strong><label for="alltag"><input id="alltag" type="checkbox" checked="checked">&nbsp;All</label>
                                <div class="panel panel-default">
                                    <div class="panel-body tag">
                                        @foreach ($tags as $tag)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="tags[{{ $tag->id }}]" checked="checked"> {{ $tag->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="submit" class="btn btn-primary " value="Filter">
                    <input type="reset" class="btn btn-default " value="Reset">
                </div>
                <form>
            </div>



        </div>



    @push('body')
        <script>
            $(document).ready(function () {

                $('#allcategory').change(function(){
                    if($(this).is(':checked'))
                        $('.cat input').prop('checked', 'checked');
                    else
                        $('.cat input').prop('checked', '');
                });
                $('#alltag').change(function(){
                    if($(this).is(':checked'))
                        $('.tag input').prop('checked', 'checked');
                    else
                        $('.tag input').prop('checked', '');
                });

            })

        </script>
    @endpush

@endsection
