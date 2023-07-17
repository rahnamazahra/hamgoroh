<!--begin::Modal-->
<div class="modal fade" id="city_create_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <h5 class="modal-title">اطلاعات را وارد نمایید</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <form class="form" role="form" autocomplete="off" id="add_city_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-body">
                    <!--begin::Alert Errors-->
                    <div id="add_errors_div"></div>
                    <!--end::Alert Errors-->
                    <div class="col-md-12 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="province_id" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام اسـتان </label>
                                <select class="form-select form-select-solid" style="width: 100%;" tabindex="-1" aria-hidden="true" name="province_id" id="province_id">
                                    <option value=""></option>
                                    @foreach($provinces as $title=>$id)
                                    <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام شهر</label>
                        <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{ old('title') }}"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="CrudHandler.createEntry('{{ route('admin.cities.store') }}','#add_city_form')">ذخیره</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">انصراف</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->



