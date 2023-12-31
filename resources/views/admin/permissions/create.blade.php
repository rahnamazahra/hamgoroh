@extends('layouts.admin.master')

@section('title', 'دسترسی‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد دسترسی</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.permissions.index') }}" class="text-muted text-hover-primary">دسترسی‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد دسترسی</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="card-header">
                <div class="card-title">ایجاد سطح دسترسی</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" id="title" name="title" value="{{ old('title') }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="slug" class="required form-label">اسلاگ</label>
                        <input type="text" class="form-control form-control-solid" id="slug" name="slug" value="{{ old('slug') }}" />
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="roles" class="required form-label">‌نقش‌ها</label>
                        <select class="form-select form-select-solid" id="roles" name="roles[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @selected(old('roles') and in_array($role->id, old('roles'))) >{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea class="form-control form-control-solid" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.permissions.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
