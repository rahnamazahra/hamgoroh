@extends('layouts.admin')
@section('title', 'شهرها')
@section('content')
@include('admin.toast.errortoast')
@can('cities-index')
<div class="card">
      <div class="card-header">
        <div class="card-title">
            <div class="d-flex flex-stack flex-wrap gap-4">
                <div class="position-relative my-1">
                    <div class="input-group">
                        <form action="{{ route('admin.cities.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="جست‌و‌جو ..." name="search_item" id="search_item"/>
                                    <span id="cityList"></span>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="form-control mb-3" value="جست‌و‌جو">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-start bd-highlight mb-8 mt-8">
                @can('cities-create')
                    <div class="p-2 bd-highlight">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#city_create_modal">جدید +</button>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="city_list" class="table table-responsive table-row-dashed align-middle fs-6 gy-4 my-0 pb-3 dataTable" data-kt-table-widget-3="all">
                <thead>
                    <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">نام شهر</th>
                        <th class="text-center">اسـتان</th>
                        <th class="text-center">اقدامات</th>
                    </tr>
                </thead>
                <tbody>

                @if(is_countable($cities))
                    @foreach($cities as $city)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                @if(($loop->index)%2==0)
                                    <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-warning"></div>
                                @else
                                    <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-info"></div>
                                @endif
                                    <a href="#" class="mb-1 text-dark text-hover-primary fw-bolder"> {{ $city->title ?? '-' }}</a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="position-relative ps-6 pe-3 py-2">
                                    <span class="mb-1 text-dark"> {{ $city->country->title }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    @can('cities-create')
                                    <a class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1" onclick="openUpdateModal({{ $city}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    @endcan
                                    @can('cities-delete')
                                    <button onclick="showDeleteAlert({{ route('categories.delete', ['city' => $city->id]) }})" type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
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
                @else
                    <td colspan="5" class="text-center">  ثبت نشده است.</td>
                @endif
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $cities->withQueryString()->links('partials.pagination') }}
         </div>
    </div>
@endcan
@include('admin.city.create')
@include('admin.city.update')
</div>
@endsection
@push('custom-scripts')
<script>
    $('#search_item').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('admin.cities.index') }}",
            type:"GET",
            data:{'query':query},
            success:function (data) {
                $('#cityList').html(data);
            }
        })
    });
    $('body').on('click', 'li', function(){
        var value = $(this).text();
    });
</script>
<script>
    function openUpdateModal(city)
    {
        var content = '<form class="form" role="form" autocomplete="off" id="update_city_form"> <input type="hidden" name="_token" value="{{csrf_token()}}"/> <div class="modal-body"> <div class="col-md-12 fv-row"> <div> <div class="form-group"> <div class="input-group"> <label for="province_id" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام اسـتان </label> <select class="form-select form-select-solid" name="province_id" id="province_id" style="width: 100%;" tabindex="-1" aria-hidden="true"> <option value=""></option> @foreach($provinces as $title=>$id) <option value="{{$id}}" @if( $city->province_id==$id) selected @endif>{{$title}}</option> @endforeach </select> </div></div></div></div><div class="col-md-12 fv-row"> <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام شهر</label> <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{old('title')}}"/> </div></div><div class="modal-footer"> <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="btn_update_city">ذخیره</button> <button type="button" class="btn btn-light" data-bs-dismiss="modal">انصراف</button> </div></form>';
        $('#update_content_div').html(content);
        $('#update_city_modal').modal('show');
        $('#update_city_form').on('submit', function (e)
        {
            e.preventDefault();
            CrudHandler.editEntry({{route('admin.cities.update', ['city'=> $city->id])}}, '#update_city_form');
        });
    }
</script>
@endpush

