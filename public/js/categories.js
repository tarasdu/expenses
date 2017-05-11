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

        $('#editCategory form div p').remove();
        $('#editCategory form input[name$="id"]').attr('value', category_id);
        $('#editCategory form input[name$="categoryName"]').val(category_name);

    });

    $('#deleteCategory').on('show.bs.modal', function (event) {

        var trigger = $(event.relatedTarget);
        var category_id = trigger.data('catid');
        var category_name = trigger.data('catname');

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
            $('#addCategory form div').append('<p class="error text-center text-danger">'+message[0]+'</p>');
        });
    })

    $('#editCategory form').on('submit', function (event) {

        event.preventDefault();
        $('#editCategory form div p').remove();

        var data = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, data, function(response) {
            $('#editCategory').modal('hide');
            window.location = '/categories';
        })
        .fail(function (response) {
            var message = $.parseJSON(response.responseText)
            $('#editCategory form div').append('<p class="error text-center text-danger">'+message[0]+'</p>');
        });
    })
})
