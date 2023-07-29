@extends('admin.competitions.master')

@section('inner_breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">تعریف زیررشته‌ها</h1>
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
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.competitions.edit', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">اطلاعات کلی مسابقه</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.groups.index', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">سبد و رشته‌ها</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">تعریف زیررشته‌ها</li>
</ul>
@endsection

@section('inner_content')
<div class="card shadow-sm">
    <form method="POST" action="{{ route('admin.challenges.store') }}">
        @csrf
        <div class="card-body">
            <div class="row g-9">
                <!--begin::Repeater-->
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="required form-label">عنوان</label>
                                        <input type="text" class="form-control mb-2 mb-md-0" name="title" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="required form-label">از تاریخ</label>
                                        <input type="text" class="form-control mb-2 mb-md-0" name="from_date" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="required form-label">تا تاریخ</label>
                                        <input type="text" class="form-control mb-2 mb-md-0" name="to_date" />
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="la la-trash-o"></i>حذف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="la la-plus"></i>
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
            </div>
            <div class="row g-9">
                <div class="col-md-12 fv-row">
                    <label for="title" class="required form-label">جنسیت</label>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                        <label class="form-check-label" for="flexRadioDefault">خواهران</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                        <label class="form-check-label" for="flexRadioDefault">برادران</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                        <label class="form-check-label" for="flexRadioDefault">هردو</label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault"/>
                        <label class="form-check-label" for="flexRadioDefault">فرقی ندارد</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.permissions.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                    <span class="indicator-label">ثبت</span>
                    <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
