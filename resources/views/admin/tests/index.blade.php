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
                <div class="card-title">
                    <div class="position-relative my-1">
                        <form method="GET" action="{{ route('admin.tests.index') }}">
                            <div class="input-group input-group-sm input-group-solid">
                                <button type="submit" class="input-group-text btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z"
                                            fill="currentColor"/>
                                        <path opacity="0.3"
                                              d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z"
                                              fill="currentColor"/>
                                    </svg>
                                </button>
                                <input type="text" class="form-control form-control-solid" placeholder="جست و جو ..."
                                       name="search_item"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-toolbar">
                    @can('tests-create')
                        <a href="{{ route('admin.tests.create') }}" class="btn btn-sm btn-primary">+ آزمون جدید</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permissions_list" class="table table-striped gy-7 gs-7">
                        <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-center">وضعیت ثبت نام</th>
                            <th class="text-center">نمایش سوالات</th>
                            <th class="text-center">مدت زمان</th>
                            <th class="text-center">تعداد سوالات</th>
                            <th class="text-center">اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($tests as $key => $test)
                            @php
                                $row_number = ($tests->currentPage() -1) * ($tests->perPage()) + ($key + 1);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $row_number }}</td>
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
                                <td class="text-center">{{ $test->duration }} دقیقه</td>
                                <td class="text-center">{{ $test->all_count }}</td>

                                <td class="text-center">
                                    <div class="btn btn-group-sm">
                                        <a href="{{ route('admin.testQuestions.create', ['test' => $test->id]) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="سوالات">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                      fill="currentColor"/>
                                                <path
                                                    d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z"
                                                    fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.tests.show', ['test' => $test->id]) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="اطلاعات تکمیلی">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                        fill="currentColor"/>
                                                    <path opacity="0.3"
                                                          d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                          fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        @can('tests-update')
                                            <a href="{{ route('admin.tests.edit', ['test' => $test->id]) }}"
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
                                                    data-id="{{ $test->id }}"
                                                    data-url="{{ route('admin.tests.delete', ['test' => $test->id]) }}"
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
            <div class="card-footer">
                {{ $tests->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endcan
@endsection
