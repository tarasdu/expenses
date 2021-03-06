<div id="editCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Редагувати категорію</h4>
            </div>
            <div class="modal-body">
                <form class="add-modal" method="POST" action="/categories/edit">
                    {{ csrf_field() }}
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="editCategoryName" class="control-label">* Ім&rsquo;я:</label>
                        <input type="text" class="form-control" id="editCategoryName" name="categoryName">
                        <small>* Обов&rsquo;язкове поле</small>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Зберегти">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Скасувати</button>
                </form>
            </div>
        </div>
    </div>
</div>
