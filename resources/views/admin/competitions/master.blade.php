@extends('layouts.admin.master')

@section('title', 'مسابقات')

@section('breadcrumb')
    @yield('inner_breadcrumb')
@endsection

@section('content')
<div class="stepper stepper-pills stepper-column d-flex flex-column flex-lg-row" id="kt_stepper_example_vertical">
    <div class="d-flex flex-row-auto w-100 w-lg-300px">
        <div class="stepper-nav flex-cente">
            <a href="{{ route('admin.competitions.edit', ['competition' => $competition->id]) }}" class="stepper-item me-5 @if (Route::is('admin.competitions.edit')) current @endif" data-kt-stepper-element="nav">
                <div class="stepper-line w-40px"></div>
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">1</span>
                </div>
                <div class="stepper-label">
                    <h3 class="stepper-title">مرحله 1</h3>
                    <div class="stepper-desc">اطلاعات کلی مسابقه</div>
                </div>
            </a>
            <a href="{{ route('admin.groups.create', ['competition' => $competition->id]) }}" class="stepper-item me-5 @if (Route::is('admin.groups.create')) current @endif" data-kt-stepper-element="nav">
                <div class="stepper-line w-40px"></div>
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">2</span>
                </div>
                <div class="stepper-label">
                    <h3 class="stepper-title">مرحله 2</h3>
                    <div class="stepper-desc">سبد و رشته‌ها</div>
                </div>
            </a>
            <a href="{{ route('admin.challenges.create', ['competition' => $competition->id]) }}" class="stepper-item me-5 @if (Route::is('admin.challenges.create')) current @endif" data-kt-stepper-element="nav">
                <div class="stepper-line w-40px"></div>
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">3</span>
                </div>
                <div class="stepper-label">
                    <h3 class="stepper-title">مرحله 3</h3>
                    <div class="stepper-desc">تعریف زیررشته‌ها</div>
                </div>
            </a>
            <a href="{{ route('admin.challenges.edit', ['competition' => $competition->id]) }}" class="stepper-item me-5 @if (Route::is('admin.challenges.edit')) current @endif" data-kt-stepper-element="nav">
                <div class="stepper-line w-40px"></div>
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">4</span>
                </div>
                <div class="stepper-label">
                    <h3 class="stepper-title">مرحله 4</h3>
                    <div class="stepper-desc">لیست زیررشته‌ها</div>
                </div>
            </a>
            <a href="#" class="stepper-item me-5" data-kt-stepper-element="nav">
                <div class="stepper-line w-40px"></div>
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">5</span>
                </div>
                <div class="stepper-label">
                    <h3 class="stepper-title">مرحله 5</h3>
                    <div class="stepper-desc">مراحل</div>
                </div>
            </a>
        </div>
    </div>
    <div class="flex-row-fluid">
        <div class="mb-5">
            <div class="flex-column current" data-kt-stepper-element="content">
                @yield('inner_content')
            </div>
        </div>

        <!--begin::Actions-->
        {{-- <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="me-2">
                <button type="button" class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                    Back
                </button>
            </div>
            <!--end::Wrapper-->

            <!--begin::Wrapper-->
            <div>
                <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
                    <span class="indicator-label">
                        Submit
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>

                <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                    Continue
                </button>
            </div>
            <!--end::Wrapper-->
        </div> --}}
        <!--end::Actions-->
    </div>
</div>
{{-- Route::currentRouteName(); --}}
@endsection
