$(document).ready(function() {

    $(".transactionRow").click(function(event) {

        var target = $(event.target);

        if (!target.is(".glyphicon-trash")) {
            window.location = $(this).data("href");
        }

    });

    $('#deleteTransaction').on('show.bs.modal', function (event) {

        var trigger = $(event.relatedTarget);
        var transaction_id = trigger.data('id');
        var date = trigger.data('date');
        var category_name = trigger.data('category');
        var amount = trigger.data('amount');

        $('#deleteTransaction .date').text(date);
        $('#deleteTransaction .category').text(category_name);
        $('#deleteTransaction .amount').text('$'+amount.toFixed(2));
        $('.transactionId').attr('value', transaction_id);

    });

})
