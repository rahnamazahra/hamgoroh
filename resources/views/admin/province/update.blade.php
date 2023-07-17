<!--begin::Modal-->
<div class="modal fade" id="province_update_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <h5 class="modal-title">اطلاعات را وارد نمایید</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opaProvince="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <form class="form" role="form" autocomplete="off" id="update_province_form">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام اسـتان</label>
                        <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{ old('title', $province->title) }}"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btn_update_province">ذخیره</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">انصراف</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->



