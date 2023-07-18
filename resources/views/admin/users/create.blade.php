<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#user_create_modal">جدید +</button>
<!--begin::Modal-->
<div class="modal fade" id="user_create_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <h5 class="modal-title">اطلاعات را وارد نمایید</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opaUser="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <form class="form" role="form" autocomplete="off" id="add_user_form">
                @csrf
                <div class="modal-body">
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label for="is_active" class="required d-flex align-items-center fs-6 fw-bold mb-2">جنسیت</label>
                            <div class="d-flex align-items-center my-5">
                                <label class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_fmale" value="1"/>
                                    <span class="form-check-label fw-bold">خـانم</span>
                                </label>
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_male" value="0"/>
                                    <span class="form-check-label fw-bold">آقـا</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="first_name" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام</label>
                            <input type="text" class="form-control form-control-solid" name="first_name" id="first_name"/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="last_name"  class="required d-flex align-items-center fs-6 fw-bold mb-2">نام خانوادگی</label>
                            <input type="text" class="form-control form-control-solid" name="last_name" id="last_name"/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="national_code"  class="required d-flex align-items-center fs-6 fw-bold mb-2">کدملی</label>
                            <input type="text" class="form-control form-control-solid" name="national_code" id="national_code"/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="birthday_date"  class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ تولد</label>
                            <input type="text"  class="form-control form-control-solid" data-jdp data-jdp-min-date="today" name="birthday_date" id="birthday_date"/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="phone"  class="required d-flex align-items-center fs-6 fw-bold mb-2">شماره موبایل</label>
                            <input type="text" class="form-control form-control-solid" name="phone" id="phone"/>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="city_id" class="required d-flex align-items-center fs-6 fw-bold mb-2">شهر</label>
                                    <select class="form-select form-select-solid" name="city_id" name="city_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">یک شهر را انتخاب کنید</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->title }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="roles" class="required d-flex align-items-center fs-6 fw-bold mb-2">نقش</label>
                                    <select class="form-select form-select-solid" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roles_list" name="roles[]" multiple="multiple">
                                        <option value="">یک نقش را انتخاب کنید</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="is_active" class="required d-flex align-items-center fs-6 fw-bold mb-2">وضعیت کاربر</label>
                            <div class="d-flex align-items-center my-5">
                                <label class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_active" value="1"/>
                                    <span class="form-check-label fw-bold">فعال</span>
                                </label>
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_deactive" value="0"/>
                                    <span class="form-check-label fw-bold">غیرفعال</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btn_add_user">ذخیره</button>
                    <button type="button" class="btn btn-light"   data-bs-dismiss="modal">انصراف</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->



