@extends('layouts.admin.master')

@section('title', 'استان ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">استان ها</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.users.index') }}" class="text-muted text-hover-primary">استان ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">استان ها</li>
    </ul>
@endsection

@section('content')
@can('provinces-index')
<div class="card shadow-sm">
    <div class="card-header">
        <div class="card-title">
            <div class="position-relative my-1">
                <div class="input-group input-group-solid">

                </div>
            </div>
        </div>
        <div class="card-toolbar">
            @can('provinces-create')
                @include('admin.provinces.create')
            @endcan
        </div>
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table id="province_list" class="table table-striped gy-7 gs-7">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">نام استان</th>
                            <th class="text-center">تعداد شهرها</th>
                            <th class="text-center">اقدامات</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse($provinces as $province)
                        <tr>
                            <td class="text-center">
                                <button type="button" onclick="toggle_inventories({{ $province->id }})" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-on">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark fw-bolder"> {{ $province->title ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="text-center"> {{ $province->cities->count() }} </td>
                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    @can('provinces-update')
                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" onclick="openUpdateProvinceModal({{ $province }})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opaprovince="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    @endcan
                                    @can('provinces-delete')
                                        <button name="btn_delete_item" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-id="{{ $province->id }}" data-url="{{ route('admin.provinces.delete', ['province' => $province->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                    <path opaprovince="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                    <path opaprovince="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @can('cities-index')
                            @foreach($province->cities as $key => $city)
                                <tr class="x{{ $city->province_id }} table-light m-4" style="display: none;">
                                    <td class="p-4 text-center">
                                        <div class="text-gray-800 fs-7 me-3"></div>
                                        <div class="text-muted fs-7 fw-bolder"> {{ $key+1 }} </div>
                                    </td>
                                    <td class="p-4 text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $city->title }}">
                                        <div class="text-gray-800 fs-7 me-3 text-center">نام شهر</div>
                                        <div class="text-muted fs-7 fw-bolder text-center">  {{ $city->title ?? '-' }} </div>
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="btn btn-group-sm">
                                            @can('cities-update')
                                                <button onclick="" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            @endcan
                                            @can('cities-delete')
                                                <button name="btn_delete_item" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-id="{{ $city->id }}" data-url="{{ route('admin.cities.delete', ['city' => $city->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endcan
                    @empty
                        <td colspan="4" class="text-center">  ثبت نشده است.</td>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">
           {{--  {{ $provinces->links('admin.partials.pagination') }}  --}}
        </div>
    </div>
    @include('admin.provinces.edit')
@endcan
@endsection

@section('custom-scripts')
<script>
    function toggle_inventories(province_id)
    {
        $('.x'+province_id).toggle();
    }
</script>

<script>
    function openAddProvinceModal()
    {
        $('#add_errors_div').empty();
        var content ='<form class="form" role="form" autocomplete="off" id="add_province_form"> <input type="hidden" name="_token" value="{{csrf_token()}}"/> <div class="modal-body"> <div id="add_errors_div"></div><div class="col-md-12 fv-row"> <div class="form-group"> <div class="input-group"> <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام اسـتان </label> <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{old('title')}}"/> </div></div></div></div><div class="modal-footer"> <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">ذخیره</button> <button type="button" class="btn btn-light" data-bs-dismiss="modal">انصراف</button> </div></form>';
        $('#add_content_div').html(content);
        $('#province_create_modal').modal('show');
        $('#add_province_form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.provinces.store') }}",
                data: $("#add_province_form").serialize(),
                success: function () {
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: "موفقیت‌آمیز",
                        text: "ثبت اطلاعات با‌موفقیت اتجام شد",
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 7000
                    });
                    window.location.reload();
                },
                error: function (xhr) {
                    $('#add_errors_div').empty();
                    var errors = '<div class="alert alert-danger alert-dismissible d-flex flex-column flex-sm-row p-5 mb-10"><span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg></span><div class="d-flex flex-column"><h4 class="mb-1 text-danger">مشکلی رخ داده است</h4>';
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        errors += '<span class="text-dark">'+value+'</span>';
                    });
                    errors += '</div></div>';
                    $('#add_errors_div').append(errors);
                }
            });
        });
    }
</script>

<script>
    function openUpdateProvinceModal(province)
    {
        $('#update_errors_div').empty();
        var content ='<form class="form" role="form" autocomplete="off" id="update_province_form"> <input type="hidden" name="_token" value="{{csrf_token()}}"/> <div class="modal-body"> <div class="col-md-12 fv-row"> <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام اسـتان</label> <input type="text" class="form-control form-control-solid" name="title" id="title" value="'+province.title+'"/> </div></div><div class="modal-footer"> <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btn_update_province">ذخیره</button> <button type="button" class="btn btn-light" data-bs-dismiss="modal">انصراف</button> </div></form>';
        $('#update_content_div').html(content);
        $('#province_update_modal').modal('show');
        $('#update_province_form').on('submit', function (e) {

            e.preventDefault();

            var url = "{{ route('admin.provinces.update', ['province' => ':province_id']) }}";
            url = url.replace(':province_id', province.id);
            $.ajax({
                type: "PATCH",
                url: url,
                data: $("#add_province_form").serialize(),
                success: function () {
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: "موفقیت‌آمیز",
                        text: "ویرایش اطلاعات با‌موفقیت انجام شد",
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 7000
                    });
                    window.location.reload();
                },
                error: function (xhr) {
                    $('#add_errors_div').empty();
                    var errors = '<div class="alert alert-danger alert-dismissible d-flex flex-column flex-sm-row p-5 mb-10"><span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg></span><div class="d-flex flex-column"><h4 class="mb-1 text-danger">مشکلی رخ داده است</h4>';
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        errors += '<span class="text-dark">'+value+'</span>';
                    });
                    errors += '</div></div>';
                    $('#add_errors_div').append(errors);
                }
            });
        });
    }
</script>
@endsection
