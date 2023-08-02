@extends('layouts.admin.master')

@section('title', 'اخبار')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">اخبار</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">اخبار</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title"> جزئیات خبر {{ $news->title }}</div>
        </div>

        <div class="card-body">

            <div class="row g-9">
                <div class="col-md-12 fv-row">
                    @php
                        $image = \App\Models\File::where('fileable_id', $news->id)->pluck('path')->first();
                    @endphp
                    <div class="image-input image-input-outline" data-kt-image-input="true"
                         style="background-image: url('assets/media/svg/avatars/blank.svg')">
                        @if($image)
                            <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: url('{{ asset('/upload/'. $image) }}')"></div>
                        @else
                            <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: url('{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}')"></div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table id="permissions_list" class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">وضعیت انتشار</th>
                        <th class="text-center">زیرعنوان</th>
                        <th class="text-center">پیش نمایش</th>
                        <th class="text-center">متن</th>
                        <th class="text-center">تگ ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">{{ $news->title }}</td>
                        <td class="text-center">
                            <div class="position-relative ps-6 pe-3 py-2">
                                @if($news->is_published==1)
                                    <span class="badge badge-light-success">فعـال</span>
                                @else
                                    <span class="badge badge-light-danger">غـیرفعـال</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">{{ $news->sub_title }}</td>
                        <td class="text-center">{{ $news->preview }}</td>
                        <td class="text-center">{!! $news->body !!}</td>
                        <td class="text-center">
                            @foreach ($news->categories as $category)
                                <span class="badge badge-light-dark">{{ $category->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{--                {{ $news->links('pagination::bootstrap-5') }}--}}
        </div>
    </div>
@endsection
