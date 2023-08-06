@extends('layouts.admin.master')

@section('title', 'معیار نمره دهی')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">معیار نمره دهی</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.criteria.index') }}" class="text-muted text-hover-primary">معیار نمره دهی</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش معیار</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.criteria.update', ['criteria' => $criteria->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش معیار {{ $criteria->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $criteria->title) }}" />
                    </div>
                    <div class="col-md-12 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            @if($criteria->is_active == 1)
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       value="1" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       value="1">
                            @endif
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.criteria.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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