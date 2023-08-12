@extends('layouts.admin.master')

@section('title', 'سوالات')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">سوالات</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.testQuestions.create', ['test' => $test]) }}"
               class="text-muted text-hover-primary">سوالات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش سوال</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST"
              action="{{ route('admin.testQuestions.update', ['test' => $test->id, 'testQuestion' => $testQuestion->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش سوال {{ $testQuestion->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">صورت سوال</label>
                        <input type="text" class="form-control form-control-solid" name="title"
                               value="{{ old('title', $testQuestion->title) }}"/>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_one" class="required form-label">گزینه 1</label>
                        <input type="text" class="form-control form-control-solid" name="option_one"
                               value="{{ old('option_one', $testQuestion->option_one) }}"/>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_two" class="required form-label">گزینه 2</label>
                        <input type="text" class="form-control form-control-solid" name="option_two"
                               value="{{ old('option_two', $testQuestion->option_two) }}"/>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_three" class="required form-label">گزینه 3</label>
                        <input type="text" class="form-control form-control-solid" name="option_three"
                               value="{{ old('option_three', $testQuestion->option_three) }}"/>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_four" class="required form-label">گزینه 4</label>
                        <input type="text" class="form-control form-control-solid" name="option_four"
                               value="{{ old('option_four', $testQuestion->option_four) }}"/>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="correct_answer" class="required form-label">گزینه صحیح</label>
                        <select class="form-select form-select-solid" id="" name="correct_answer" data-control="select2"
                                data-hide-search="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="1" @selected($testQuestion->correct_answer == '1')>گزینه 1</option>
                            <option value="2" @selected($testQuestion->correct_answer == '2')>گزینه 2</option>
                            <option value="3" @selected($testQuestion->correct_answer == '3')>گزینه 3</option>
                            <option value="4" @selected($testQuestion->correct_answer == '4')>گزینه 4</option>
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="level" class="required form-label">سطح سوال</label>
                        <select class="form-select form-select-solid" id="" name="level" data-control="select2"
                                data-hide-search="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="easy" @selected($testQuestion->level == 'easy')>آسان</option>
                            <option value="normal" @selected($testQuestion->level == 'normal')>متوسط</option>
                            <option value="hard" @selected($testQuestion->level == 'hard')>سخت</option>
                        </select>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="ancillary_answer" class="required form-label">گزینه های صحیح فرعی</label>
                        <select class="form-select form-select-solid" id="ancillary_answer" name="ancillary_answer[]"
                                data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                            <option value="1" {{ in_array('1', json_decode($testQuestion->ancillary_answer)) ? 'selected' : '' }}>گزینه 1</option>
                            <option value="2" {{ in_array('2', json_decode($testQuestion->ancillary_answer)) ? 'selected' : '' }}>گزینه 2</option>
                            <option value="3" {{ in_array('3', json_decode($testQuestion->ancillary_answer)) ? 'selected' : '' }}>گزینه 3</option>
                            <option value="4" {{ in_array('4', json_decode($testQuestion->ancillary_answer)) ? 'selected' : '' }}>گزینه 4</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.testQuestions.create', ['test' => $test]) }}"
                       id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
