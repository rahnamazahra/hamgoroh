@extends('layouts.admin.master')

@section('title', 'گروه‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">گروه‌ها</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.groups.index') }}" class="text-muted text-hover-primary">گروه‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش گروه</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.groups.update', ['group' => $group->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش گروه {{ $group->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" id="title" name="title" value="{{ old('title', $group->title) }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="image" class="required form-label">تصویر</label>
                        <input type="text" class="form-control form-control-solid" id="image" name="image" value="{{ old('image', $group->image) }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="competition" class="required form-label">دوره</label>
                        <select class="form-select form-select-solid" id="competition" name="competition_id" data-control="select2" data-allow-clear="true" data-placeholder="دوره را انتخاب کنید">
                            <option></option>
                            @foreach($competitions as $competition)
                                <option value="{{ $competition->id }}" @if ($group->competition->id == $competition->id) selected @endif>{{ $competition->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="fields" class="required form-label">‌رشته‌ها</label>
                        <select class="form-select form-select-solid" id="fields" name="fields[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                            @foreach($fields as $field)
                                <option value="{{ $field->id }}" @selected((old('fields') and in_array($field->id, old('fields'))) or $group->fields->contains($field->id))>{{ $field->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.groups.index') }}" id="update_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                    <button type="submit" id="update_permission_form_submit" class="btn btn-primary">
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
