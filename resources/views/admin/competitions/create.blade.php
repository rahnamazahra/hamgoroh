@extends('layouts.admin.master')

@section('title', 'دوره ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد دوره</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">دوره‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد دوره</li>
    </ul>
@endsection

@section('content')
    {{-- @include('admin.errors.error-message') --}}
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.competitions.store') }}">
            @csrf
            <div class="card-header">
                <div class="card-title">ایجاد دوره</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title') }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="registration_start_time" class="required form-label">زمان شروع</label>
                        <input type="txt" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_start_time" name="registration_start_time" value="{{ old('registration_start_time') }}" />
                    <span id="calendar"></span>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="registration_finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2"> زمان پایان</label>
                        <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_finish_time" name="registration_finish_time" value="{{ old('registration_finish_time') }}"/>
                        <span id="calendar"></span>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="registration_description" class="required form-label">توضیحات</label>
                        <textarea class="form-control form-control-solid" name="registration_description">{{ old('registration_description') }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="rules_description" class="required form-label">قوانین</label>
                        <textarea class="form-control form-control-solid" name="rules_description">{{ old('rules_description') }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="letter_method" class="required form-label">شیوه نامه</label>
                        <textarea class="form-control form-control-solid" name="letter_method">{{ old('letter_method') }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="banner" class="required form-label">بنر</label>
                        <textarea class="form-control form-control-solid" name="banner">{{ old('banner') }}</textarea>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="creator" class="required form-label">ایجادکننده</label>
                        <select class="form-select form-select-solid" name="creator" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                            @foreach($users as $user)
                                <option value='{{ $user->id }}'>{{ $user->first_name . ' ' . $user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @if(old('is_active') == 1) checked @endif>
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>

                    {{--                    <div class="col-md-12 fv-row">--}}
{{--                        <label>وضعیت</label>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="is_active" id="is_active1" value="1" @if(old('is_active') == 1) checked @endif>--}}
{{--                            <label class="form-check-label" for="is_active1">فعال</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="is_active" id="is_active2" value="0" @if(old('is_active') == 0) checked @endif>--}}
{{--                            <label class="form-check-label" for="is_active2">غیرفعال</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-12 fv-row">--}}
{{--                        <label for="description" class="form-label">توضیحات</label>--}}
{{--                        <textarea class="form-control form-control-solid" name="description">{{ old('description') }}</textarea>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.competitions.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
@endsection
@section('custom-scripts')
<script>
    jalaliDatepicker.startWatch();
</script>
@endsection
