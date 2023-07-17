<!--begin::Modal-->
<div class="modal fade" id="fieldUpdateModal" wire:ignore.self tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش رشته</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opaUser="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <form>
                <div class="modal-body">
                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label for="title" class="required form-label">عنوان</label>
                            <input type="text" class="form-control form-control-solid" wire:model.defer="title" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"   data-bs-dismiss="modal">لغو</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click.prevent="update({{ $field_id }})">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->
