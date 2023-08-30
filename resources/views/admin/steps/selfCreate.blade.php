@extends('layouts.admin.master')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد مراحل </h1>
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
        <li class="breadcrumb-item text-dark">ایجاد مرحله</li>
    </ul>
@endsection

@section('content')

    <div class="card shadow-sm">
        <form method="POST"
              action="{{ route('admin.steps.selfStore', ['competition' => $competition->id]) }}">
            @csrf
            {{--            <div class="card-header">--}}
            {{--                <div class="card-title">ویرایش دوره {{ $competition->title }}</div>--}}
            {{--            </div>--}}
            <div class="card-body">
                <div class="row g-9 my-2">
                    <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
                    <div class="col-md-3 fv-row">
                        <label class="required form-label">عنوان</label>
                        <input type="text" class="form-control mb-2 mb-md-0" name="title" value="{{ old('title') }}"/>
                    </div>
                    <div class="col-md-3">
                        <label for="level" class="required form-label">سطح</label>
                        <select class="form-select" id="" name="level" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="provincial">استانی</option>
                            <option value="country">کشوری</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type" class="required form-label">نوع آزمون</label>
                        <select class="form-select" id="" name="type" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="video_upload">آپلود ویدئو</option>
                            <option value="image_upload">آپلود عکس</option>
                            <option value="voice_upload">آپلود صوت</option>
                            <option value="document_upload">آپلود سند</option>
                            <option value="text">متن</option>
                            <option value="call">تماس تلفنی</option>
                            <option value="test">آزمون آنلاین چهارگزینه ای</option>
                            <option value="video_online">آزمون آنلاین تصویری</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="weight" class="required form-label">ضریب</label>
                        <input type="number" class="form-control mb-2 mb-md-0" name="weight" min="1" max="10" value="{{ old('weight') }}"/>
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
