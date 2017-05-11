@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('content')


    <div id="main" class="container">

        @include('modals/addCategory')
        @include('modals/editCategory')
        @include('modals/deleteCategory')

        @if($categories->count() == 0)
            <div class="jumbotron">
                <p class="text-center">You don't have any categories yet; would you like to <a href="#addCategory" data-toggle="modal">add one</a>?</p>
            </div>
        @else
            <div>
                <a href="#addCategory" data-toggle="modal" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Category</a>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><br>{{ $category->name }}</td>
                            <td>
                                <br>
                                <a class="edit-icon" href="#editCategory" data-toggle="modal" data-catid="{{ $category->id }}" data-catname="{{ $category->name }}">
                                    <span class="glyphicon glyphicon-edit">&nbsp;</span>
                                </a>
                                <a class="delete-icon" href="#deleteCategory" data-toggle="modal" data-catid="{{ $category->id }}" data-catname="{{ $category->name }}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br>
        @endif
    </div>

    @push('body')
        <script src="/js/categories.js"></script>
    @endpush

@endsection
