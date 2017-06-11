$(document).ready(function() {

    // Modals on show events

    $('#addCategory').on('show.bs.modal', function (event) {

        $('#addCategory form div').removeClass('has-error')
        $('#addCategory form div span').remove();
        $('#addCategory form input[name$="categoryName"]').val('');

    });

    $('#editCategory').on('show.bs.modal', function (event) {

        var trigger = $(event.relatedTarget);
        var category_id = trigger.data('catid');
        var category_name = trigger.data('catname');

        $('#editCategory form div').removeClass('has-error')
        $('#editCategory form div span').remove();
        $('#editCategory form input[name$="id"]').attr('value', category_id);
        $('#editCategory form input[name$="categoryName"]').val(category_name);

    });

    $('#deleteCategory').on('show.bs.modal', function (event) {

        var trigger = $(event.relatedTarget);
        var category_id = trigger.data('catid');
        var category_name = trigger.data('catname');

        $('#deleteCategory .info').text('Видалити категорію "' + category_name + '"?');
        $('#deleteCategory form input[name$="id"]').attr('value', category_id);

    });


    // Modals on submit events

    $('#addCategory form').on('submit', function (event) {

        event.preventDefault();
        $('#addCategory form div').removeClass('has-error')
        $('#addCategory form div span').remove();

        var data = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, data, function(response) {
            $('#addCategory').modal('hide');
            window.location = '/categories';
        })
        .fail(function (response) {
            var message = $.parseJSON(response.responseText);
            $('#addCategory form div').addClass('has-error')
            $('#addCategory form div').append('<span class="help-block"><strong>'+message[0]+'</strong></span>');
        });
    })

    $('#editCategory form').on('submit', function (event) {

        event.preventDefault();
        $('#editCategory form div').removeClass('has-error')
        $('#editCategory form div span').remove();

        var data = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, data, function(response) {
            $('#editCategory').modal('hide');
            window.location = '/categories';
        })
        .fail(function (response) {
            var message = $.parseJSON(response.responseText);
            $('#editCategory form div').addClass('has-error')
            $('#editCategory form div').append('<span class="help-block"><strong>'+message[0]+'</strong></span>');
        });
    })
})
