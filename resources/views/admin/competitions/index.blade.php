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
        <li class="breadcrumb-item text-dark">دوره‌ها</li>
    </ul>
@endsection

@section('content')
    @can('competitions-index')
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title">
                    <div class="position-relative my-1">
                        <form method="GET" action="{{ route('admin.competitions.index') }}">
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
                    @can('competitions-create')
                        <form method="post" action="{{ route('admin.competitions.store') }}">
                            @csrf
                            <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                                <span class="indicator-label">دوره جدید+</span>
                                <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                            </button>
                        </form>
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
                            <th class="text-center">وضعیت</th>
{{--                            <th class="text-center">وضعیت</th>--}}
                            <th class="text-center">زمان شروع ثبت نام</th>
                            <th class="text-center">زمان پایان ثبت نام</th>
                            {{--                        <th class="text-center">توضیحات</th>--}}
                            {{--                        <th class="text-center">قوانین</th>--}}
                            {{--                        <th class="text-center">شیوه نامه</th>--}}
                            {{--                        <th class="text-center">بنر</th>--}}
                            <th class="text-center">ایجاد کننده</th>
                            <th class="text-center">اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($competitions as $key => $competition)
                            @php
                                $row_number = ($competitions->currentPage() -1) * ($competitions->perPage()) + ($key + 1);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $row_number }}</td>
                                <td class="text-center">{{ $competition->title }}</td>
                                <td class="text-center">
                                    <div class="position-relative ps-6 pe-3 py-2">
                                        @if($competition->is_active==1)
                                            <span class="badge badge-light-success">فعـال</span>
                                        @else
                                            <span class="badge badge-light-danger">غـیرفعـال</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_time))->format('Y/m/d H:i:s') }}</td>
                                <td class="text-center">{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_finish_time))->format('Y/m/d H:i:s') }}</td>
                                {{--                            <td class="text-center">{{ $competition->registration_description }}</td>--}}
                                {{--                            <td class="text-center">{{ $competition->rules_description }}</td>--}}
                                {{--                            <td class="text-center">{{ $competition->letter_method }}</td>--}}
                                {{--                            <td class="text-center">{{ $competition->banner }}</td>--}}
                                <td class="text-center">{{ $competition->user ? $competition->user->first_name . ' ' . $competition->user->last_name : ' '}}</td>

                                <td class="text-center">
                                    <div class="btn btn-group-sm">
                                        <a href="{{ route('admin.competitions.show', ['competition' => $competition->id]) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom" title="مدیریت مسابقه">
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
                                        <a href="{{ route('admin.competitions.charts', ['competition' => $competition->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="مشاهده نمودار">
                                            <span class="svg-icon svg-icon-33">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="currentColor"/>
                                                    <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        @can('competitions-update')
                                            <a href="{{ route('admin.competitions.edit', ['competition' => $competition->id]) }}"
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
                                        @can('competitions-delete')
                                            <button name="btn_delete_item"
                                                    class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"
                                                    data-id="{{ $competition->id }}"
                                                    data-url="{{ route('admin.competitions.delete', ['competition' => $competition->id]) }}"
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
                {{ $competitions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endcan
@endsection
