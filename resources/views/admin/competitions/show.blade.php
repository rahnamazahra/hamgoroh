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
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">دوره‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">مشاهده دوره</li>
    </ul>
@endsection

@section('content')
    @can('competitions-index')
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title"> جزئیات دوره {{ $competition->title }}</div>
            </div>
            <div class="card-body">

                <div class="row g-9">
                    <div class="col-md-12 fv-row">
                        @php
                            $image = \App\Models\File::where('fileable_id', $competition->id)->where('related_field', 'banner')->pluck('path')->first();
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
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">زمان شروع ثبت نام</th>
                            <th class="text-center">زمان پایان ثبت نام</th>
                            <th class="text-center">ایجاد کننده</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">قوانین</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                                <td class="text-center">{{ $competition->user ? $competition->user->first_name . ' ' . $competition->user->last_name : ' '}}</td>
                                <td class="text-center">{!! $competition->registration_description !!}</td>
                                <td class="text-center">{!! $competition->rules_description !!}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                @php
                    $letter_method = \App\Models\File::where('fileable_id', $competition->id)->where('related_field', 'letter_method')->pluck('path')->first();
                @endphp
                @if($letter_method)
                <a href="{{ url('upload/'.$letter_method) }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary btn-hover-rise">
                    <i class="bi bi-download"></i>  دانلود شیوه نامه</a>
                @endif

            </div>
            <div class="card-footer">
{{--                {{ $competitions->links('pagination::bootstrap-5') }}--}}
            </div>
        </div>
    @endcan
@endsection
