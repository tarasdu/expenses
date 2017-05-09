<div id="addCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">

            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">New Category</h4>
            </div>
            <div class="modal-body">
                <form class="add-modal" method="POST" action="/categories/new">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="categoryName" class="control-label">* Name:</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Create">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>

    </div>
</div>
