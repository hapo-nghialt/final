<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px">
        <div class="modal-content">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin cá nhân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container edit-user-form row m-0">
                    <div class="col-md-3 p-0 d-flex justify-content-center flex-column align-items-center">
                        <div class="user-avatar" id="user-avatar">
                            <img src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : asset('images/avatar-null.png') }}" alt="">
                        </div>
                        <div class="preview-user-avatar" id="preview-user-avatar">
                            <img src="#" alt="" id="previewUserAvatar" class="d-none">
                        </div>
                        <input type="file" hidden name="avatar" id="avatar">
                        <label for="avatar" class="text-change-avatar">
                            Thay Đổi
                        </label>
                    </div>
                    <div class="col-md-9">
                        <div class="row m-0">
                            <div class="col-3 d-flex align-items-center form-title">
                                Họ và tên
                            </div>
                            <div class="col-9 form-item">
                                <input type="text" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-3 d-flex align-items-center form-title">
                                Địa chỉ
                            </div>
                            <div class="col-9 form-item">
                                <input type="text" name="address" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-3 d-flex align-items-center form-title">
                                Email
                            </div>
                            <div class="col-9 form-item">
                                <input type="text" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-3 d-flex align-items-center form-title">
                                Số điện thoại
                            </div>
                            <div class="col-9 form-item">
                                <input type="text" name="phone_number" value="{{ $user->phone_number }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" id="updateUser">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
