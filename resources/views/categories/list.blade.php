@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('content')



    <div id="main" class="container">

        @include('modals/addCategory')
        @include('modals/editCategory')
        @include('modals/deleteCategory')

        @if(count($categories) == 0)
            <div class="jumbotron">
                <p class="text-center">You don't have any categories yet; would you like to <a href='/categories/new'>add one</a>?</p>
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
        <script>

            $(document).ready(function() {

                // Modals on show events

                $('#addCategory').on('show.bs.modal', function (event) {

                    $('#addCategory form div p').remove();
                    $('#addCategory form input[name$="categoryName"]').val('');

                });

                $('#editCategory').on('show.bs.modal', function (event) {

                    var trigger = $(event.relatedTarget);
                    var category_id = trigger.data('catid');
                    var category_name = trigger.data('catname');
                    console.log(trigger);
                    console.log(category_id, category_name);
                    $('#editCategory form div p').remove();
                    $('#editCategory form input[name$="id"]').attr('value', category_id);
                    $('#editCategory form input[name$="categoryName"]').val(category_name);

                });

                $('#deleteCategory').on('show.bs.modal', function (event) {

                    var trigger = $(event.relatedTarget);
                    var category_id = trigger.data('catid');
                    var category_name = trigger.data('catname');
                    console.log(category_id, category_name);

                    $('#deleteCategory .info').text('Delete category "' + category_name + '"?');
                    $('#deleteCategory form input[name$="id"]').attr('value', category_id);

                });


                // Modals on submit events

                $('#addCategory form').on('submit', function (event) {

                    event.preventDefault();
                    $('#addCategory form div p').remove();

                    var data = $(this).serialize();
                    var url = $(this).attr('action');

                    $.post(url, data, function(response) {
                        $('#addCategory').modal('hide');
                        window.location = '/categories';
                    })
                    .fail(function (response) {
                        var message = $.parseJSON(response.responseText)
                        console.log(message[0]);
                        $('#addCategory form div').append('<p class="error text-center text-danger">'+message[0]+'</p>');

                    });

                })

                $('#editCategory form').on('submit', function (event) {

                    event.preventDefault();
                    $('#editCategory form div p').remove();

                    var data = $(this).serialize();
                    var url = $(this).attr('action');
                    console.log(url);

                    $.post(url, data, function(response) {
                        $('#editCategory').modal('hide');
                        window.location = '/categories';
                    })
                    .fail(function (response) {
                        var message = $.parseJSON(response.responseText)
                        console.log(message[0]);
                        $('#editCategory form div').append('<p class="error text-center text-danger">'+message[0]+'</p>');
                        //console.log($('#editCategory form input[name$="categoryName"]').val());
                        //console.log($('#editCategory form input[name$="categoryName"]').attr('value'));
                    });

                })
            })


        </script>
    @endpush

@endsection
