@extends('layouts.admin.master')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد زیررشته‌ </h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست دوره‌های
                مسابقات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.show', ['competition' => $competition]) }}"
               class="text-muted text-hover-primary">مدیریت دوره</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد زیررشته‌</li>
    </ul>
@endsection

@section('content')

    <div class="card shadow-sm">
        <form method="POST"
              action="{{ route('admin.challenges.selfStore', ['competition' => $competition->id]) }}">
            @csrf
            {{--            <div class="card-header">--}}
            {{--                <div class="card-title">ویرایش دوره {{ $competition->title }}</div>--}}
            {{--            </div>--}}
            <div class="card-body">

                <div class="row g-9 my-2">
                    <input type="hidden" name="field_id" value="{{ $field->id }}"/>
                    <div class="col-md-4 fv-row">
                        <label for="age_id" class="required form-label">بازه سنی</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="لطفا انتخاب کنید" id="age_id" name="age_id">
                            <option></option>
                            @foreach ($competition->ages as $age)
                                <option
                                    value="{{ $age->id }}">{{ $age->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 fv-row">
                        <label for="gender" class="required form-label">جنسیت</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="لطفا انتخاب کنید" id="gender" name="gender">
                            <option></option>
                            <option value="-1">همه</option>
                            <option value="0">خانم‌ها</option>
                            <option value="1">آقایان</option>
                        </select>
                    </div>
                    <div class="col-md-4 fv-row">
                        <label for="nationality" class="required form-label">ملیت</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="لطفا انتخاب کنید" id="nationality" name="nationality">
                            <option></option>
                            <option value="-1">همه</option>
                            <option value="0">ایرانی</option>
                            <option value="1">خارجی</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.competitions.show', ['competition' => $competition->id]) }}"
                       id="add_permission_form_cancel"
                       class="btn btn-light me-3">لغو</a>
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
