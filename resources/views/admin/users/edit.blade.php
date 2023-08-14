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
        <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویراش کاربر {{ $user->first_name }} {{ $user->last_name }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-lg-8">
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                            @if($avatar)
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('/upload/'. $avatar) }}')"></div>
                            @else
                               <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('admin/assets/media/avatars/man.png') }}')"></div>
                            @endif
                            <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تغییر آواتار">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                <input type="hidden" name="avatar_remove">
                            </label>
                        </div>
                        <div class="form-text"> فایل های مجاز: png, jpg, jpeg.</div>
                    </div>
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
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"  @if($user->is_active == 1) checked='checked' @endif>
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="province_id" class="required form-label">استان</label>
                        <select class="form-select form-select-solid" id="province_id" name="province_id" onchange="getCities(this.value)" data-control="select2" data-allow-clear="true" data-placeholder="استان را انتخاب کنید">
                            <option></option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" @selected((old('province_id') and in_array($province->id, old('province_id'))) or $user->city->province->id == $province->id)>{{ $province->title }}</option>
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
                        <div class="d-flex d-inline-block gap-10">
                            <label for="evidence" class="required form-label"> مدرک </label>
                        </div>
                        <input type="file" name="evidence" id="evidence" class="form-control form-control-solid" accept="">
                        <div class="form-text my-auto"> فایل‌های مجاز: </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="roles" class="required form-label">نقش(ها)</label>
                                <select class="form-select form-select-solid" id="roles" name="roles[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @selected((old('roles') and in_array($role->id, old('roles'))) or $user->roles->contains($role->id))>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required form-label">جنسیت</label>
                        <div class="d-flex align-items-center my-5">
                            <label for="gender_fmale" class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_fmale" value="0" @if ($user->gender == "0") checked @endif/>
                                <span class="form-check-label fw-bold">خـانم</span>
                            </label>
                            <label for="gender_male" class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="radio" name="gender" id="gender_male" value="1" @if ($user->gender == "1") checked @endif/>
                                <span class="form-check-label fw-bold">آقـا</span>
                            </label>
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



