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
                <div class="table-responsive">
                    <table id="permissions_list" class="table table-striped gy-7 gs-7">
                        <thead>
                        <tr>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">قوانین</th>
                            <th class="text-center">شیوه نامه</th>
                            <th class="text-center">بنر</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $competition->registration_description }}</td>
                                <td class="text-center">{{ $competition->rules_description }}</td>
                                <td class="text-center">{{ $competition->letter_method }}</td>
                                <td class="text-center">{{ $competition->banner }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
{{--                {{ $competitions->links('pagination::bootstrap-5') }}--}}
            </div>
        </div>
    @endcan
@endsection
