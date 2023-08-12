@extends('layouts.admin.master')

@section('title', 'سوالات')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد سوال</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.tests.index') }}" class="text-muted text-hover-primary">سوالات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد سوال</li>
    </ul>
@endsection

@section('content')
    @php
        $easy = \App\Models\TestQuestion::query()->where('test_id', $test->id)->where('level', 'easy')->count();
        $normal = \App\Models\TestQuestion::query()->where('test_id', $test->id)->where('level', 'normal')->count();
        $hard = \App\Models\TestQuestion::query()->where('test_id', $test->id)->where('level', 'hard')->count();
        $total = $easy + $normal + $hard;

        $remaining_easy = $test->easy_count - $easy;
        $remaining_normal = $test->normal_count - $normal;
        $remaining_hard = $test->hard_count - $hard;
    @endphp

    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.testQuestions.store', ['test' => $test->id]) }}">
            @csrf
            <div class="card-header">
                <div class="card-title">ایجاد سوال</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">صورت سوال</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title') }}" />
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_one" class="required form-label">گزینه 1</label>
                        <input type="text" class="form-control form-control-solid" name="option_one" value="{{ old('option_one') }}" />
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_two" class="required form-label">گزینه 2</label>
                        <input type="text" class="form-control form-control-solid" name="option_two" value="{{ old('option_two') }}" />
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_three" class="required form-label">گزینه 3</label>
                        <input type="text" class="form-control form-control-solid" name="option_three" value="{{ old('option_three') }}" />
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="option_four" class="required form-label">گزینه 4</label>
                        <input type="text" class="form-control form-control-solid" name="option_four" value="{{ old('option_four') }}" />
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="correct_answer" class="required form-label">گزینه صحیح</label>
                        <select class="form-select form-select-solid" id="" name="correct_answer" data-control="select2"
                                data-hide-search="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="1">گزینه 1</option>
                            <option value="2">گزینه 2</option>
                            <option value="3">گزینه 3</option>
                            <option value="4">گزینه 4</option>
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="level" class="required form-label">سطح سوال</label>
                        <select class="form-select form-select-solid" id="" name="level" data-control="select2"
                                data-hide-search="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            <option value="easy">آسان</option>
                            <option value="normal">متوسط</option>
                            <option value="hard">سخت</option>
                        </select>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="ancillary_answer" class="required form-label">گزینه های صحیح فرعی</label>
                        <select class="form-select form-select-solid" id="ancillary_answer" name="ancillary_answer[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                            <option value="1">گزینه 1</option>
                            <option value="2">گزینه 2</option>
                            <option value="3">گزینه 3</option>
                            <option value="4">گزینه 4</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="g-4 m-2">
                <span><h3>  تعداد سوالات ساخته شده</h3></span></div>
            <div class="row">
                <div class="col-4 fv-row">
                    <span>آسان: {{$easy}}</span>
                </div>
                <div class="col-4 fv-row">
                    <span>متوسط: {{$normal}}</span>
                </div>
                <div class="col-4 fv-row">
                    <span>سخت: {{$hard}}</span>
                </div>
            </div>


            <span class="g-4 m-2"><h3>  تعداد سوالات باقی مانده</h3>
            <div class="row g-9 m-2">
                <div class="col-4">
                    <span>آسان: {{$remaining_easy}}</span>
                </div>
                <div class="col-4">
                    <span>متوسط: {{$remaining_normal}}</span>
                </div>
                <div class="col-4">
                    <span>سخت: {{$remaining_hard}}</span>
                </div>
            </div>
            </span>


            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tests.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                    <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                        <span class="indicator-label">ثبت</span>
                        <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>

        <div class="card-header">
            <div class="card-title"> سوالات آزمون</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="permissions_list" class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr>
                        <th class="text-center">صورت سوال</th>
                        <th class="text-center">سطح سوال</th>
                        <th class="text-center">گزینه 1</th>
                        <th class="text-center">گزینه 2</th>
                        <th class="text-center">گزینه 3</th>
                        <th class="text-center">گزینه 4</th>
                        <th class="text-center">گزینه صحیح</th>
                        <th class="text-center">اقدامات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($testQuestions as $testQuestion)
                        <tr>
                            <td class="text-center">{{ $testQuestion->title }}</td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    @if($testQuestion->level=='easy')
                                        <span class="badge badge-light-success">آسان</span>
                                    @elseif($testQuestion->level=='normal')
                                        <span class="badge badge-light-primary">متوسط</span>
                                    @else
                                        <span class="badge badge-light-danger">سخت</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">{{ $testQuestion->option_one }}</td>
                            <td class="text-center">{{ $testQuestion->option_two }}</td>
                            <td class="text-center">{{ $testQuestion->option_three }}</td>
                            <td class="text-center">{{ $testQuestion->option_four }}</td>
                            <td class="text-center">گزینه {{ $testQuestion->correct_answer }}</td>

                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    @can('tests-update')
                                        <a href="{{ route('admin.testQuestions.edit', ['test' => $test->id, 'testQuestion' => $testQuestion->id]) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                              d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                              fill="currentColor"></path>
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                        </a>
                                    @endcan
                                    @can('tests-delete')
                                        <button name="btn_delete_item"
                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"
                                                data-id="{{ $testQuestion->id }}"
                                                data-url="{{ route('admin.testQuestions.delete', ['testQuestion' => $testQuestion->id]) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                    fill="currentColor"></path>
                                                <path opauser="0.5"
                                                      d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                      fill="currentColor"></path>
                                                <path opauser="0.5"
                                                      d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                      fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="10">‌آیتمی برای نمایش وجود ندارد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
