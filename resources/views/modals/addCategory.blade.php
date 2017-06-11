<div id="addCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Нова категорія</h4>
            </div>
            <div class="modal-body">
                <form class="add-modal" method="POST" action="/categories/new">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="addCategoryName" class="control-label">* Ім&rsquo;я:</label>
                        <input type="text" class="form-control" id="addCategoryName" name="categoryName">
                        <small>* Обов&rsquo;язкове поле</small>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Create">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Скасувати</button>
                </form>
            </div>
        </div>
    </div>
</div>
