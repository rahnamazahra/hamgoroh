@extends('layouts.admin.master')

@section('title', 'گروه‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد گروه</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.groups.index') }}" class="text-muted text-hover-primary">گروه‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد گروه</li>
    </ul>
@endsection

@section('content')

{{--                <form method="POST" action="{{ route('admin.groups.store') }}">--}}
{{--                    @csrf--}}
{{--                    --}}
{{--                </form>--}}




    <div class="card shadow-sm">
        <!--begin::Repeater-->
        <div id="kt_docs_repeater_basic">
            <!--begin::Form group-->
            <div class="form-group">
{{--                <form method="post" action="{{ route('admin.groups.store') }}">--}}
{{--                    @csrf--}}
                <div data-repeater-list="kt_docs_repeater_basic">
                    <div class="card-header">
                        <div class="card-title">ایجاد گروه بندی</div>
                    </div>
                    <div data-repeater-item>

                        <div class="card-body">

                            <div class="row g-9">
                                <div class="col-md-3 fv-row">
                                    <label for="title" class="required form-label">عنوان</label>
                                    <input type="text" class="form-control form-control-solid" id="title" name="title"
                                           value="{{ old('title') }}"/>
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label for="image" class="required form-label">تصویر</label>
                                    <input type="text" class="form-control form-control-solid" id="image" name="image"
                                           value="{{ old('image') }}"/>
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label for="fields" class="required form-label">‌رشته‌ها</label>
                                    <select class="form-select form-select-solid" id="fields" name="fields[]"
                                            data-control="select2" data-placeholder="لطفا انتخاب کنید"
                                            multiple="multiple">
                                        <option></option>
                                        @foreach($fields as $field)
                                            <option
                                                value="{{ $field->id }}" @selected(old('fields') and in_array($field->id, old('fields'))) >{{ $field->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <a href="javascript:;" data-repeater-delete
                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                </form>--}}

            </div>




            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                    <i class="la la-plus"></i>Add
                </a>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.groups.index') }}" id="add_permission_form_cancel"
                       class="btn btn-light me-3">لغو</a>
                    <a href="{{ route('admin.groups.store') }}" id="add_permission_form_submit"
                       class="btn btn-primary ">ثبت</a>
{{--                    <button type="submit" id="add_permission_form_submit" class="btn btn-primary">--}}
{{--                        <span class="indicator-label">ثبت</span>--}}
{{--                        <span class="indicator-progress">لطفا چند لحظه صبر کنید ...--}}
{{--                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>--}}
{{--                            </span>--}}
{{--                    </button>--}}
                </div>
            </div>
            <!--end::Form group-->
        </div>
        <!--end::Repeater-->
    </div>

@endsection

@section('custom-scripts')
    <script src="{{asset('admin/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

    <script>
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endsection
