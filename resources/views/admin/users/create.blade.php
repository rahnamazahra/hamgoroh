@extends('layouts.admin.master')
@section('title', 'ایجاد کاربر جدید')
@section('content')
@can('users-create')
    <div class="card">
        <div class="card-body">
            <div class="mb-13 text-center">
                <h1 class="mb-3">ایجاد کاربر جدید</h1>
            </div>
            <form method="POST" action="{{ route('admin.users.store')}}" id="add_user_form" class="form" autocomplete="off">
                @csrf
                <div class="row g-9 mb-8">
                    <div class="col-md-6 fv-row">
                        <label for="first_name" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام</label>
                        <input type="text" class="form-control form-control-solid" id="first_name" name="first_name" value="{{ old('first_name') }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="last_name" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام خانوادگی</label>
                        <input type="text" class="form-control form-control-solid" id="last_name" name="last_name" value="{{ old('last_name') }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="birthday_date" class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ تولد</label>
                        <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="birthday_date" name="birthday_date" value="{{ old('birthday_date') }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="national_code" class="required d-flex align-items-center fs-6 fw-bold mb-2">کدملی</label>
                        <input type="text" class="form-control form-control-solid input-just-number" id="national_code" name="national_code" value="{{ old('national_code') }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="phone" class="required d-flex align-items-center fs-6 fw-bold mb-2">شماره موبایل</label>
                        <input type="text" class="form-control form-control-solid input-just-number" id="phone" name="phone" value="{{ old('phone') }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required d-flex align-items-center fs-6 fw-bold mb-2">وضعیت کاربر</label>
                        <div class="d-flex align-items-center my-5">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_active" value="1" @if(old('is_active')=="1") checked='checked' @endif checked/>
                                <span class="form-check-label fw-bold">فعال</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_deactive" value="0" @if(old('is_active')=="0") checked='checked' @endif/>
                                <span class="form-check-label fw-bold">غیرفعال</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="provinces_list" class="required fs-6 fw-bold mb-2">استان</label>
                        <select class="form-select form-select-solid" id="provinces_list" name="province_id" onchange="getCities(this.value)" data-control="select2" data-allow-clear="true" data-placeholder="استان را انتخاب کنید">
                            <option></option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}"  @if (old('province_id') == $province->id) selected @endif>{{ $province->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="cities_list" class="required fs-6 fw-bold mb-2">شهر</label>
                        <select class="form-select form-select-solid" id="cities_list" name="city_id" data-control="select2" data-allow-clear="true" data-placeholder="شهر را انتخاب کنید" disabled>
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required d-flex align-items-center fs-6 fw-bold mb-2">جنسیت</label>
                        <div class="d-flex align-items-center my-5">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_fmale" value="0" @if(old('is_active')=="0") checked='checked' @endif/>
                                <span class="form-check-label fw-bold">خـانم</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_male" value="1" @if(old('is_active')=="1") checked='checked' @endif/>
                                <span class="form-check-label fw-bold">آقـا</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                               <label for="roles_list" class="required d-flex align-items-center fs-6 fw-bold mb-2">نقش(ها)</label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="roles_list" name="roles[]" multiple="multiple">
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-submit w-100 mb-5">
                        <span class="indicator-label">ثبت</span>
                        <span class="indicator-progress">لطفا چندلحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-light">لغو</a>
                </div>
            </form>
        </div>
    </div>
@endcan
@endsection
@section('custom-scripts')
<script>
    jalaliDatepicker.startWatch();
</script>
<script>
    function getCities(val)
    {
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            type: "POST",
            url: "{{ route('admin.ajax.cities') }}",
            data: {province_id: val},
            success: function (data) {
                $("#cities_list").empty();
                $("#cities_list").attr('disabled', false);
                $("#cities_list").append('<option value="">لطفا انتخاب کنید</option>');
                $.each(data.cities, function (key, value) {
                    $("#cities_list").append('<option value=' + value.id + '>' + value.title + '</option>');
                });
            },
            error: function (data) {
                console.log("fail");
            }
        });
    }
</script>
@endsection




