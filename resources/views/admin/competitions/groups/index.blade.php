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
        <li class="breadcrumb-item text-dark">ویرایش گروه بندی مسابقه</li>
    </ul>
@endsection

@section('inner_content')
    <div class="card shadow-sm">
        @if($competition->groups()->exists())
            <div class="card shadow-sm">
                <form method="POST" action="{{ route('admin.groups.update', ['competition' => $competition->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row g-9">
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <div class="d-flex justify-content-between">
                                    <span class="fs-3 fw-bold">سبد</span>
                                    <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-success"><i class="la la-plus"></i>افزودن</a>
                                </div>
                                <div class="form-group">
                                    <div data-repeater-list="groups">
                                        @foreach($competition->groups as $key => $group)
                                            <div class="form-group row mb-4" data-repeater-item>
                                                <div class="col-md-3">
                                                    <label class="required form-label">عنوان</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="title" value="{{ $group->title }}"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="required form-label">تصویر</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="image" value="{{ $group->image }}"
                                                           data-jdp/>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="fields" class="required form-label">‌رشته‌ها</label>
                                                    <select class="form-select" id="fields_{{rand(100000,110000000)}}" name="fields[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                                                        <option></option>
                                                        @foreach($fields as $field)
                                                            <option value="{{ $field->id }}" @selected(old('fields') and in_array($field->id, old('fields'))) >{{ $field->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="javascript:;" data-repeater-delete
                                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="la la-trash-o"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div data-repeater-item>
                                            <div class="form-group row mb-4">
                                                <div class="col-md-3">
                                                    <label class="required form-label">عنوان</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="title"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="required form-label">تصویر</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="image"
                                                           data-jdp/>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="fields" class="required form-label">‌رشته‌ها</label>
                                                    <select class="form-select" id="fields_{{rand(100000,110000000)}}" name="fields[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                                                        <option></option>
                                                        @foreach($fields as $field)
                                                            <option value="{{ $field->id }}" @selected(old('fields') and in_array($field->id, old('fields'))) >{{ $field->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="javascript:;" data-repeater-delete
                                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="la la-trash-o"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Repeater-->
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.competitions.index') }}" id="add_permission_form_cancel"
                               class="btn btn-light me-3">لغو</a>
                            <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                                <span class="indicator-label">مرحله بعد</span>
                                <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="card shadow-sm">
                <form method="POST" action="{{ route('admin.groups.store', ['competition' => $competition->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row g-9">
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <div class="d-flex justify-content-between">
                                    <span class="fs-3 fw-bold">سبد</span>
                                    <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-success"><i
                                            class="la la-plus"></i>افزودن</a>
                                </div>
                                <div class="form-group">
                                    <div data-repeater-list="groups">
                                        <div data-repeater-item>
                                            <div class="form-group row mb-4">
                                                <div class="col-md-3">
                                                    <label class="required form-label">عنوان</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="title"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="required form-label">تصویر</label>
                                                    <input type="text" class="form-control mb-2 mb-md-0" name="image"
                                                           data-jdp/>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="fields" class="required form-label">‌رشته‌ها</label>
                                                    <select class="form-select" id="fields_{{rand(100000,110000000)}}" name="fields[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                                                        <option></option>
                                                        @foreach($fields as $field)
                                                            <option value="{{ $field->id }}" @selected(old('fields') and in_array($field->id, old('fields'))) >{{ $field->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <a href="javascript:;" data-repeater-delete
                                                       class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="la la-trash-o"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Repeater-->
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.competitions.index') }}" id="add_permission_form_cancel"
                               class="btn btn-light me-3">لغو</a>
                            <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                                <span class="indicator-label">مرحله بعد</span>
                                <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
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
