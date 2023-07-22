@extends('layouts.admin.master')

@section('title', 'کاربران')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">کاربران</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.users.index') }}" class="text-muted text-hover-primary">کاربران</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش کاربر</li>
    </ul>
@endsection

@section('content')
@can('users-update')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویراش کاربر {{ $user->first_name }} {{ $user->last_name }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="first_name" class="required form-label">نام</label>
                        <input type="text" class="form-control form-control-solid" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="last_name" class="required form-label">نام خانوادگی</label>
                        <input type="text" class="form-control form-control-solid" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="birthday_date" class="required form-label">تاریخ تولد</label>
                        <input type="text"  class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="birthday_date" name="birthday_date"
                            @if (!$user->birthday_date)
                                value=""
                            @else
                                value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($user->birthday_date))->format('Y/m/d')}}"
                            @endif
                        data-jdp/>
                        <span id="calendar"></span>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="national_code" class="required form-label">کدملی</label>
                        <input type="text" class="form-control form-control-solid" id="national_code" name="national_code" value="{{ old('national_code', $user->national_code) }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="phone"  class="required form-label">شماره موبایل</label>
                        <input type="text" class="form-control form-control-solid" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required form-label">وضعیت کاربر</label>
                        <div class="d-flex align-items-center my-5">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_active" value="1" @if ($user->is_active == "1") checked @endif/>
                                <span class="form-check-label fw-bold">فعال</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="radio" name="is_active" id="user_deactive" value="0" @if ($user->is_active == "0") checked @endif/>
                                <span class="form-check-label fw-bold">غیرفعال</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="provinces_list" class="required form-label">استان</label>
                        <select class="form-select form-select-solid" id="provinces_list" name="province_id" onchange="getCities(this.value)" data-control="select2" data-allow-clear="true" data-placeholder="استان را انتخاب کنید">
                            <option></option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" @if ($user->city->province->id == $province->id) selected @endif>{{ $province->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="cities_list" class="required form-label">شهر</label>
                        <select class="form-select form-select-solid" id="cities_list" name="city_id" data-control="select2" data-allow-clear="true" data-placeholder="شهر را انتخاب کنید">
                            <option></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ($user->city_id == $city->id) selected @endif>{{ $city->title }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required form-label">جنسیت</label>
                        <div class="d-flex align-items-center my-5">
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_fmale" value="0" @if ($user->is_active == "0") checked @endif/>
                                <span class="form-check-label fw-bold">خـانم</span>
                            </label>
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_male" value="1" @if ($user->is_active == "1") checked @endif/>
                                <span class="form-check-label fw-bold">آقـا</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="roles_list" class="required form-label">نقش(ها)</label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="roles_list" name="roles[]" multiple="multiple">
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if ($user->roles()->wherePivot('role_id', $role->id)->exists()) selected @endif>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                    <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                        <span class="indicator-label">ثبت</span>
                        <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endcan
@endsection

@section('custom-scripts')
<script type="text/javascript">
    jalaliDatepicker.startWatch();
</script>
<script>
function getCities(val)
{
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "{{ route('admin.ajax.cities') }}",
        type: "POST",
        headers: { "X-CSRF-TOKEN": token },
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



