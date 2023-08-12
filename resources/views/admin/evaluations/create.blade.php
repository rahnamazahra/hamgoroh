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
        <li class="breadcrumb-item text-dark"> داور جدید </li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm col-xl-12">
        <form method="POST" action="{{ route('admin.evaluations.store', ['step' => $step->id])}}">
            @csrf
            <div class="card-header">
                <div class="card-title">افزودن داور</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 row">
                        <div class="col-md-6 fv-row my-5">
                            <label for="criteria_id" class="form-label">معیار</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="criteria_id" name="criteria_id">
                                <option></option>
                                @foreach ($criterias as $criteria)
                                    <option value="{{ $criteria->id }}" @selected(old('criteria_id') and in_array($criteria->id))>{{ $criteria->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 fv-row my-5">
                            <label for="refereeing_type" class="form-label">نوع داوری</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="refereeing_type" name="refereeing_type">
                                <option></option>
                                <option value="first">فردی</option>
                                <option value="average">گروهی</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-6 fv-row my-5">
                            <label for="referee_id" class="form-label"> داوران </label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="referee_id" name="referees[]" multiple="multiple">
                                <option></option>
                                @foreach ($referees as $referee)
                                    <option value="{{ $referee->id }}" @selected(old('referees') and in_array($role->id, old('referees')))>{{ $referee->first_name }} {{ $referee->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row my-5">
                            <label for="point" class="form-label"> نمره </label>
                            <input type="text" class="form-control form-control-solid" id="point" name="point" value="{{ old('point') }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.evaluations.index', ['step' => $step->id]) }}" class="btn btn-light me-3">لغو</a>
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

