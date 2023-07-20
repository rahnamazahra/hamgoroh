@extends('layouts.admin.master')
@section('title', 'ایجاد کاربر جدید')
@section('content')
@can('users-create')
    <div class="card">
        <div class="card-body">
            <div class="mb-13 text-center">
                <h1 class="mb-3">ایجاد کاربر جدید</h1>
            </div>
            @include('admin.errors.error_message')
            <form method="POST" action="{{ route('admin.users.store')}}" id="add_user_form" class="form" autocomplete="off">
                @csrf
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
                        <input type="text" class="form-control form-control-solid" id="first_name" name="first_name"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="last_name"  class="required d-flex align-items-center fs-6 fw-bold mb-2">نام خانوادگی</label>
                        <input type="text" class="form-control form-control-solid" id="last_name" name="last_name"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="national_code"  class="required d-flex align-items-center fs-6 fw-bold mb-2">کدملی</label>
                        <input type="text" class="form-control form-control-solid" id="national_code" name="national_code"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="birthday_date"  class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ تولد</label>
                        <input type="text"  class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="birthday_date" name="birthday_date"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="phone"  class="required d-flex align-items-center fs-6 fw-bold mb-2">شماره موبایل</label>
                        <input type="text" class="form-control form-control-solid" id="phone" name="phone"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="provinces_list" class="required d-flex align-items-center fs-6 fw-bold mb-2">استان</label>
                                <select class="form-select form-select-solid" id="provinces_list" name="province_id" onchange="getCities(this.value)">
                                    <option value="">یک استان را انتخاب کنید</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->title }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="cities_list" class="required d-flex align-items-center fs-6 fw-bold mb-2">شهر</label>
                                <select class="form-select form-select-solid" id="cities_list" name="city_id" disabled>
                                    <option value="">یک شهر را انتخاب کنید</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="roles" class="required d-flex align-items-center fs-6 fw-bold mb-2">نقش</label>
                                <select class="form-select form-select-solid" style="width: 100%;" id="roles_list" name="roles[]" multiple="multiple">
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
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-submit w-100 mb-5">
                        <span class="indicator-label">ثبت</span>
                        <span class="indicator-progress">لطفا چندلحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <a href="{{ rout('admin.users.index')}}" type="button" class="btn btn-light">برگشت</button>
                </div>
            </form>
        </div>
    </div>
@endcan
@endsection
@push('custom-scripts')
<script type="text/javascript">
    jalaliDatepicker.startWatch();
</script>
<script>
function getCities(val)
{
    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        type: "POST",
        url: "{{ route('ajax.subfields') }}",
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
@endpush




