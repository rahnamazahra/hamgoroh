@extends('layouts.admin.master')
@section('title', 'ویرایش کاربر')
@section('content')
@include('admin.errors.message')
@can('users-update')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update')}}" id="update_user_form" class="form" autocomplete="off">
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
                                <select class="form-select form-select-solid" name="city_id" id="city_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                                <select class="form-select form-select-solid" name="roles" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">یک نقش را انتخاب کنید</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if ($user->roles()->wherePivot('role_id', $role->id)->exists()) selected @endif>{{ $role->title }}</option>
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
                </div>
                <a href="{{ rout('admin.users.index')}}" type="button" class="btn btn-light">برگشت</button>
            </form>
        </div>
    </div>
@endcan
@endsection
@push('custom-scripts')
<script type="text/javascript">
    jalaliDatepicker.startWatch();
</script>
@endpush


