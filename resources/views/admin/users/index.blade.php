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
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.users.index') }}" class="text-muted text-hover-primary">کاربران</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">کاربران</li>
    </ul>
@endsection

@section('content')
@can('users-index')
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                <div class="position-relative my-1">
                    <div class="input-group input-group-solid">

                    </div>
                    <div class="input-group input-group-solid">
                        <form method="GET" action="{{ route('admin.users.index') }}" id="sort_users_form" name="sort_users_form" class="mx-auto w-100 fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="d-flex align-items-center fw-bolder" data-select2-id="select2-data-122-u471">
                                <div class="text-gray-400 fs-7 me-2">نقش</div>
                                <select name="item_roles" id="item_roles" class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto select2-hidden-accessible" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="لطفا انتخاب کنید" tabindex="-1" aria-hidden="true">
                                    <option value="all" @if (request()->query('item_roles') == 'all') selected @endif>همه</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if(request()->query('item_roles') == $role->id ) selected @endif>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-toolbar">
                @can('users-create')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">کابر جدید +</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="users_list" class="table table-striped gy-7 gs-7">
                    <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">نام خانوادگی</th>
                            <th class="text-center">کدملی</th>
                            <th class="text-center">تلفن همراه</th>
                            <th class="text-center">شهر</th>
                            <th class="text-center">نقش ها</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <a href="#" class="mb-1 text-dark text-hover-primary"> {{ $user->first_name }}</a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->last_name }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->national_code }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $user->phone }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark">{{ $user->city->province->title }}</span>
                                    <div class="text-muted">
                                        <span>{{ $user->city->title }}</span>
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
                                    @if($user->is_active==1)
                                        <span class="badge badge-light-success">فعـال</span>
                                    @else
                                        <span class="badge badge-light-danger">غـیرفعـال</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    <button data-bs-toggle="modal" data-bs-target="" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="اطلاعات تکمیلی">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"/>
                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                    </button>
                                    @can('users-update')
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    @endcan
                                    @can('users-delete')
                                    <button name="btn_delete_item" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-id="{{ $user->id }}" data-url="{{ route('admin.users.delete', ['user' => $user->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="9" class="text-center">  ثبت نشده است.</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
           {{--  {{ $users->links('admin.partials.pagination') }}  --}}
        </div>
    </div>
@endcan
@endsection
@section('custom-scripts')
<script>
    $(document).ready(function() {
        $('#item_roles').on('change', function() {
            document.forms['sort_users_form'].submit();
        });
    });
</script>
@endsection
