@extends('layouts.admin.master')

@section('title', 'دوره‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">دوره‌ها</h1>
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
        <li class="breadcrumb-item text-muted">
            <a href="" class="text-muted text-hover-primary">مدیریت دوره</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">تکنیک جدید</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm col-xl-12">
        <form method="POST" action="{{ route('admin.techniques.store', ['challenge' => $challenge->id])}}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <div class="card-title">تکنیک جدید</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                     <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title') }}"/>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4 fv-row my-5">
                    <div class="d-flex d-inline-block gap-10">
                        <label for="file" class="required form-label">فایل</label>
                    </div>
                    <input type="file" name="file" class="form-control form-control-solid" accept="">
                    <div class="form-text my-auto"> فایل‌های مجاز: </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.techniques.index', ['challenge' => $challenge->id]) }}" class="btn btn-light me-3">لغو</a>
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
