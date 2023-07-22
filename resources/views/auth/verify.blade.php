@extends('layouts.auth.index')

@section('title', 'اعتبارسنجی')

@section('content')

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('site') }}" class="mb-12">
                <img alt="Logo" src="{{ asset('admin/assets/media/logos/logo.png') }}" class="h-80px" />
            </a>
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form action="{{ route('verify.config') }}" method="POST" class="form w-100 mb-10" novalidate="novalidate" id="kt_sing_in_two_steps_form">
                    @csrf
                    <div class="text-center mb-10">
                        <img alt="Logo" class="mh-125px" src="{{ asset('admin/assets/media/svg/misc/smartphone.svg') }}" />
                    </div>
                    <input type="hidden" name="phone" value="{{ $phone }}"/>
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">اعتبارسنجی دومرحله‌ای</h1>
                        <div class="text-muted fw-bold fs-5 mb-5">ما یک کد برای شماره زیر ارسال کردیم</div>
                        <div class="fw-bolder text-dark fs-3">{{ $phone }}</div>
                    </div>
                    <div class="mb-10 px-md-10">
                        <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">کد 6 رقمی را وارد کنید:</div>
                        <div class="d-flex flex-wrap flex-stack">
                            <input type="text" class="form-control form-control-lg form-control-solid input-just-number" name="password" autocomplete="off" />
                        </div>
                    </div>
                    <div class="d-flex flex-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-submit fw-bolder">
                            <span class="indicator-label">ورود</span>
                            <span class="indicator-progress">لطفا چندلحظه صبر کنید ...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
                <div class="text-center fw-bold fs-5">
                    <span class="text-muted me-1">کد را دریافت نکردید؟</span>
                    <a href="#" class="link-primary fw-bolder fs-5 me-1">ارسال مجدد</a>
                    <span class="text-muted me-1">یا</span>
                    <a href="#" class="link-primary fw-bolder fs-5">با ما ارتباط بگیرید</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
