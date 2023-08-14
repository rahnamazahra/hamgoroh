@extends('layouts.admin.master')

@section('title', 'کاربران')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">کاربران</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">کاربران</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <div class="input-group input-group-sm input-group-solid">
                        <button type="submit" class="input-group-text btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor" />
                                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor" />
                            </svg>
                        </button>
                        <input type="text" class="form-control form-control-solid" placeholder="جست و جو ..." name="search_item" />
                    </div>
                </form>
                <div class="p-2 align-items-center gap-4 m-5">
                    <button type="button" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-bs-toggle="collapse" data-bs-target="#filter_search">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                            </svg>
                        </span>
                        فیلتر
                    </button>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="p-2 align-items-center gap-4">
                    <a href="{{ route('admin.users.exporUsers') }}" class="btn btn-sm btn-flex btn-outline btn-outline-success btn-active-success fw-bolder" data-bs-toggle="tooltip" data-bs-placement="bottom" title="خروجی Excel">خروجی Excel</a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="کاربر جدید">+ کابر جدید</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="filter_search" class="collapse">
                <form method="GET" action="{{ route('admin.users.index') }}" class="mx-auto w-100 fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="row mb-8">
                        <div class="col-md-2 fv-row">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">نقش</div>
                                <select name="roles_item" id="roles_item" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="لطفا انتخاب کنید" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('roles_item') == 'all') selected @endif>همه</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if (request()->query('roles_item') == $role->id) selected @endif>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 fv-row">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">وضعیت</div>
                                <select name="status_item" id="status_item" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="لطفا انتخاب کنید" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('status_item') == 'all') selected @endif>همه</option>
                                    <option value="1" @if (request()->query('status_item') == '1') selected @endif>فعال</option>
                                    <option value="0" @if (request()->query('status_item') == '0') selected @endif>غیرفعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 fv-row">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">جنسیت</div>
                                <select name="gender_item" id="gender_item" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="لطفا انتخاب کنید" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('gender_item') == 'all') selected @endif>همه</option>
                                    <option value="1"  @if (request()->query('gender_item') == '1') selected @endif>مرد</option>
                                    <option value="0"  @if (request()->query('gender_item') == '0') selected @endif>زن</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 fv-row">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">مدرک</div>
                                <select name="evidence_item" id="evidence_item" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="لطفا انتخاب کنید" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('evidence_item') == 'all') selected @endif>همه</option>
                                    <option value="1">دارد</option>
                                    <option value="0">ندارد</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 fv-row">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">استان</div>
                                <select name="province_item" id="province_item" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="همه" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('province_item') == 'all') selected @endif>همه</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}"> {{ $province->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="جست‌وجو">جست‌و‌جو</button>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('admin.users.index') }}" id="btn_remove_filter" class="btn btn-sm btn-bg-light btn-active-color-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف فیلتر">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                        <path opauser="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                        <path opauser="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table id="users_list" class="table table-striped gy-7 gs-7">
                    <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">نام و نام خانوادگی</th>
                            <th class="text-center">کدملی</th>
                            <th class="text-center">تلفن همراه</th>
                            <th class="text-center">شهر</th>
                            <th class="text-center">نقش ها</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">مدرک</th>
                            <th class="text-center">اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $key => $user)
                        @php
                            $row_number = ($users->currentPage() -1) * ($users->perPage()) + ($key + 1);
                        @endphp
                        <tr>
                            <td class="text-center"> {{ $row_number }} </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <a href="#" class="mb-1 text-dark text-hover-primary"> {{ $user->first_name.' '.$user->last_name }} </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->national_code }} </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->phone }} </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->city->province->title }} </span>
                                    <div class="text-muted">
                                        <span> {{ $user->city->title }} </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    @foreach ($user->roles as $role)
                                        @if ($role->id == 1)        <!--Developer Role-->
                                            <span class="badge badge-light-dark">{{ $role->title }}</span>
                                        @elseif ($role->id == 2)    <!--Admin Role-->
                                            <span class="badge badge-light-primary">{{ $role->title }}</span>
                                        @elseif ($role->id == 3)    <!--General manager Role-->
                                            <span class="badge badge-light-success">{{ $role->title }}</span>
                                        @elseif ($role->id == 4)    <!--Provincial manager Role-->
                                            <span class="badge badge-light-info">{{ $role->title }}</span>
                                        @elseif ($role->id == 5)    <!--Referee manager Role-->
                                            <span class="badge badge-light-info">{{ $role->title }}</span>
                                        @elseif ($role->id == 6)    <!--User manager Role-->
                                            <span class="badge badge-light-info">{{ $role->title }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    @if ($user->is_active==1)
                                        <span class="badge badge-light-success">فعـال</span>
                                    @else
                                        <span class="badge badge-light-danger">غـیرفعـال</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $evidence = $user->files->where('related_field','evidence')->pluck('path')->first();
                                @endphp
                                @if ($evidence)
                                   <a href="{{ url('upload/'.$evidence) }}"> دانلود مدرک  </a>
                                @else
                                    ندارد
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom"  title="اطلاعات تکمیلی">
                                            <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
                                            </svg></span>
                                    </button>
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <button name="btn_delete_item" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-id="{{ $user->id }}" data-url="{{ route('admin.users.delete', ['user' => $user->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td class="text-center" colspan="9">‌آیتمی برای نمایش وجود ندارد.</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('custom-scripts')
<script>
    function showRemoveFilter()
    {
        $('#btn_remove_filter').css('display','block');
    }
</script>
<script>
    function hiddenRemoveFilter()
    {
        $('#btn_remove_filter').css('display','none');
    }
</script>
@endsection
