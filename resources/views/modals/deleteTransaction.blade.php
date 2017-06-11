<div id="deleteTransaction" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">

            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Видалити транзакцію?</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2" class="date">
                    </tr>
                    <tr>
                        <th class="category"></th>
                        <th class="amount"></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <form class="delete-modal" method="POST" action="/transactions/delete">
                    {{ csrf_field() }}
                    <input class="transactionId" type='hidden' name='id'>
                    <input type="submit" class="btn btn-primary" value="Так">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ні</button>
                </form>
            </div>
        </div>

    </div>
</div>
