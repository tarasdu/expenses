<div id="deleteCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">
            <div class="modal-body">
                <p class="info text-center"></p>
            </div>
            <div class="modal-footer">
                <form class="delete-modal" method="POST" action="/categories/delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                    <input type="submit" class="btn btn-primary" value="Так">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ні</button>
                </form>
            </div>
        </div>
    </div>
</div>
