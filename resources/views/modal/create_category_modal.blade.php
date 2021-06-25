<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container edit-user-form">
                    <div class="row m-0">
                        <div class="col-3 d-flex align-items-center form-title">
                            Tên danh mục:
                        </div>
                        <div class="col-9 form-item">
                            <input type="text" name="name">
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="preview-category" id="preview-user-avatar">
                            <img src="#" alt="" id="previewCategoryImage" class="d-none">
                        </div>
                        <input type="file" hidden name="image" id="image">
                        <label for="image" class="text-change-avatar">
                            Tải ảnh lên
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Tạo mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
