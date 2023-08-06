@extends('admin.competitions.master')

@section('inner_breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">گروه بندی مسابقه</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست دوره‌های
                مسابقات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">مراحل</li>
    </ul>
@endsection

@section('inner_content')
<div class="card shadow-sm">
    <form method="POST" action="{{ route('admin.steps.store', ['competition' => $competition->id]) }}">
        @csrf
        <div class="card-body">
            <div class="row g-9">
                <!--begin::Repeater-->
                <div id="kt_docs_repeater_nested">
                    <!--begin::Form group-->
                        <!--begin::Add repeat group-->
                        <div class="d-flex justify-content-end">
                            <a href="javascript:;" data-repeater-create class="btn btn-primary btn-flex h-40px border-0 fw-bolder px-4 px-lg-6"> افزودن گروه <i class="la la-plus"></i></a>
                        </div>
                        <!--end::Add repeat group-->
                        <!--begin::repeat-group-->
                        <div data-repeater-list="groups">
                            <div data-repeater-item>
                                <div class="separator my-10"></div>
                                <div class="form-group row mb-5">
                                    <div class="col-md-3 mb-10">
                                        <label class="required form-label">زیررشته ها</label>
                                        <select class="form-select select2-element multi-select" id="" name="challenges" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                                            <option></option>
                                            @foreach($challenges as $challange)
                                                <option value="{{ $challange->id }}"> {{ $challange->field->title }} {{ $challange->age->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--begin::inner-repeater-->
                                    <div class="form-group row mb-4" style="position: relative;">
                                        <div id="inner-repeater" class="inner-repeater">
                                            <div data-repeater-list="steps" class="mb-5">
                                                <div class="d-flex flex-row-reverse" style="position: absolute;padding:0px;top:-80px;left:0px;">
                                                    <div class="p-2">
                                                        <button class="btn btn-sm btn-light-success" data-repeater-create type="button"> افزودن <i class="la la-plus"></i></button>
                                                    </div>
                                                    <div class="p-2">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger"><i class="la la-trash-o fs-3"></i>حذف گروه</a>
                                                    </div>
                                                </div>
                                                <div data-repeater-item>
                                                <!--repeat inner form-->
                                                    <div class="form-group row mb-4">
                                                        <div class="col-md-1">
                                                            <span class="btn btn-sm btn-light text-dark mt-3 mt-md-8 row_number" name="row_number">
                                                            </span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="required form-label">عنوان</label>
                                                            <input type="text" class="form-control mb-2 mb-md-0" name="title" value=""/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="level" class="required form-label">سطح</label>
                                                            <select class="form-select" id="" name="level" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                                                                <option></option>
                                                                <option value="provincial">استانی</option>
                                                                <option value="country">کشوری</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="type" class="required form-label">نوع آزمون</label>
                                                            <select class="form-select" id="" name="type" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                                                                <option></option>
                                                                <option value="video_upload">آپلود ویدئو</option>
                                                                <option value="image_upload">آپلود عکس</option>
                                                                <option value="voice_upload">آپلود صوت</option>
                                                                <option value="document_upload">آپلود سند</option>
                                                                <option value="text">متن</option>
                                                                <option value="call">تماس تلفنی</option>
                                                                <option value="test">آزمون آنلاین چهارگزینه ای</option>
                                                                <option value="video_online">آزمون آنلاین تصویری</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label for="weight" class="required form-label">ضریب</label>
                                                            <input type="number" class="form-control mb-2 mb-md-0" name="weight" min="1" max="10"/>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="la la-trash-o fs-3"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!--repeat inner form-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::inner-repeater-->
                                </div>
                            </div>
                        </div>
                        <!--end::repeat-group-->
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
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

@section('custom-scripts')
<script src="{{asset('admin/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script>
    const dropdowns = document.querySelectorAll('.multi-select');
    dropdowns.forEach((dropdown) => {
        dropdown.addEventListener('change', (e) => {
            const selectedOptions = Array.from(e.target.selectedOptions).map(option => option.value);
            dropdowns.forEach((otherDropdown) => {
                if (otherDropdown !== dropdown) {
                    Array.from(otherDropdown.options).forEach((option) => {
                    if (selectedOptions.includes(option.value)) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                    });
                }
            });
        });
    });
</script>
<script>
    var row_number=0;
    document.getElementsByClassName('row_number')[0].innerHTML=++row_number;
    $('#kt_docs_repeater_nested').repeater({
        repeaters: [{
            selector: '.inner-repeater',
            show: function () {
                var phn = $(this).find('.row_number');

                $(this).slideDown();
                phn.html(++row_number);
            },

            hide: function (deleteElement) {
                --row_number;
                $(this).slideUp(deleteElement);
            }
        }],

        show: function () {
            $('.select2-element').select2();
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>
@endsection
