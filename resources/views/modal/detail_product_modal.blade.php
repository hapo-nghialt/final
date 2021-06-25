<div class="modal fade" id="detailProduct{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container edit-user-form row m-0">
                <div class="col-md-3 p-0 d-flex justify-content-center flex-column align-items-center">
                    <div class="user-avatar" id="user-avatar">
                        <img src="{{ asset('storage/products/' . $value->image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row m-0">
                        <div class="col-3 d-flex align-items-center form-title">
                            Tên sản phẩm
                        </div>
                        <div class="col-9 form-item">
                            {{ $value->name }}
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-3 d-flex align-items-center form-title">
                            Giá
                        </div>
                        <div class="col-9 form-item">
                            {{ number_format($value->price, 0) }} ₫
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-3 d-flex align-items-center form-title">
                            Nơi phân phối
                        </div>
                        <div class="col-9 form-item">
                            {{ $value->address }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
