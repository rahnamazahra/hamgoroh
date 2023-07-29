@extends('admin.competitions.master')

@section('inner_breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ویرایش اطلاعات کلی مسابقه</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست دوره‌های مسابقات</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش اطلاعات کلی مسابقه</li>
</ul>
@endsection

@section('inner_content')
فرم ویرایش دوره
@endsection
