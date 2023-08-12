@extends('layouts.admin.master')

@section('title', 'آزمونهای چهارگزینه ای')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">آزمونهای چهارگزینه ای</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">آزمونهای چهارگزینه ای</li>
    </ul>
@endsection

@section('content')
    @can('tests-index')
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title"> جزئیات آزمون {{ $test->title }}</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permissions_list" class="table table-striped gy-7 gs-7">
                        <thead>
                        <tr>
                            <th class="text-center">عنوان</th>
                            <th class="text-center">وضعیت ثبت نام</th>
                            <th class="text-center">نمایش سوالات</th>
                            <th class="text-center">مدت زمان</th>
                            <th class="text-center">تعداد سوالات</th>
                            <th class="text-center">نمایش رندم</th>
                            <th class="text-center">محدودیت ورود</th>
                            <th class="text-center">نمره منفی</th>
                            <th class="text-center">نمایش نمره</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $test->title }}</td>
                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->is_active==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->show_question=='single')
                                            <span class="badge badge-light-info">تکی</span>
                                        @else
                                            <span class="badge badge-light-primary">همه</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">{{ $test->duration }} دقیقه </td>
                                <td class="text-center">{{ $test->all_count }}</td>

                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->is_random==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->is_limit==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->is_negative==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($test->is_score==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
{{--        </div>--}}


{{--        <div class="card shadow-sm">--}}
            <div class="card-header">
                <div class="card-title"> سوالات آزمون {{ $test->title }}</div>
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
            <div class="card-footer">
                {{--                {{ $tests->links('pagination::bootstrap-5') }}--}}
            </div>
        </div>
    @endcan
@endsection
