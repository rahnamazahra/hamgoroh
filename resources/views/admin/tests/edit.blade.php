@extends('layouts.admin.master')

@section('title', 'آزمونهای چهارگزینه ای')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">آزمون ها</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.tests.index') }}" class="text-muted text-hover-primary">رشته‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش آزمون</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.tests.update', ['test' => $test->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش آزمون {{ $test->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">

                    <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $test->title) }}" />
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="show_question" class="required form-label">نحوه آزمون</label>
                        <select class="form-select form-select-solid" id="" name="show_question" data-control="select2"
                                data-hide-search="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="all" @if($test->show_question == 'all') selected @endif>نمایش یکباره سوالات</option>
                            <option value="single" @if($test->show_question == 'single') selected @endif>نمایش تک به تک سوالات</option>
                        </select>
                    </div>


                    <div class="col-md-6 fv-row">
                        <label for="duration" class="required form-label">مدت زمان</label>
                        <input type="number" class="form-control form-control-solid" name="duration"
                               value="{{ old('duration', $test->duration) }}"/>
                    </div>

                    <div class="col-md-2 fv-row">
                        <label for="easy_count" class="required form-label">تعداد سوالات آسان</label>
                        <input type="number" class="form-control form-control-solid" name="easy_count"
                               value="{{ old('easy_count', $test->easy_count) }}"/>
                    </div>
                    <div class="col-md-2 fv-row">
                        <label for="normal_count" class="required form-label">تعداد سوالات متوسط</label>
                        <input type="number" class="form-control form-control-solid" name="normal_count"
                               value="{{ old('normal_count', $test->normal_count) }}"/>
                    </div>
                    <div class="col-md-2 fv-row">
                        <label for="hard_count" class="required form-label">تعداد سوالات سخت</label>
                        <input type="number" class="form-control form-control-solid" name="hard_count"
                               value="{{ old('hard_count', $test->hard_count) }}"/>
                    </div>


                    <div class="col-md-3 fv-row">
                        <div class="d-flex flex-column mt-4">
                            <div class="mb-4">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input type="hidden" name="is_random" value="0">
                                    @if($test->is_random == 1)
                                    <input class="form-check-input" type="checkbox" name="is_random" value="1"
                                           id="is_random" checked/>
                                    @else
                                        <input class="form-check-input" type="checkbox" name="is_random" value="1"
                                               id="is_random"/>
                                    @endif
                                    <label class="form-check-label" for="is_random">
                                        نمایش رندم گزینه ها
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input type="hidden" name="is_limit" value="0">
                                    @if($test->is_limit == 1)
                                    <input class="form-check-input" type="checkbox" name="is_limit" value="1"
                                           id="is_limit" checked/>
                                    @else
                                        <input class="form-check-input" type="checkbox" name="is_limit" value="1"
                                               id="is_limit"/>
                                    @endif
                                    <label class="form-check-label" for="is_limit">
                                        محدودیت زمان ورود کاربر
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 fv-row">
                        <div class="d-flex flex-column mt-4">
                            <div class="mb-4">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input type="hidden" name="is_negative" value="0">
                                    @if($test->is_negative == 1)
                                    <input class="form-check-input" type="checkbox" name="is_negative" value="1"
                                           id="is_negative" checked/>
                                    @else
                                        <input class="form-check-input" type="checkbox" name="is_negative" value="1"
                                               id="is_negative"/>
                                    @endif
                                    <label class="form-check-label" for="is_negative">
                                        نمره منفی دارد
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input type="hidden" name="is_score" value="0">
                                    @if($test->is_score == 1)
                                    <input class="form-check-input" type="checkbox" name="is_score" value="1"
                                           id="is_score" checked/>
                                    @else
                                        <input class="form-check-input" type="checkbox" name="is_score" value="1"
                                               id="is_score"/>
                                    @endif
                                    <label class="form-check-label" for="is_score">
                                        نمایش نمرات پس از پایان
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            @if($test->is_active == 1)
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
                    <a href="{{ route('admin.fields.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
