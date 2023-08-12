@extends('layouts.admin.master')

@section('title', 'اطلاعیه‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد اطلاعیه</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.notices.index') }}" class="text-muted text-hover-primary">اطلاعیه‌ها</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ایجاد اطلاعیه</li>
    </ul>
@endsection

@section('content')
    {{-- @include('admin.errors.error-message') --}}
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.notices.store') }}">
            @csrf
            <div class="card-header">
                <div class="card-title">ایجاد اطلاعیه</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title"
                               value="{{ old('title') }}"/>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="description" class="required form-label">متن</label>
                        <textarea class="form-control" rows="3" id="textarea"
                                  name="description">{{ old('description') }}</textarea>
                    </div>


                    <div class="col-md-12 fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="" value="1"
                                   id="referees"/>
                            <label class="form-check-label" for="">
                                انتخاب داوران
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 fv-row" id="container_selected_referees" style="display: none">
                        <select class="form-select form-select-solid" id="selected_referees" name="selected_referees[]"
                                data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-4 fv-row" id="container_all_referees" style="display: none">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_sent_referees" value="1"
                                   id="all_referees"/>
                            <label class="form-check-label" for="is_sent_referees">
                                همه
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="" value="1"
                                   id="generals"/>
                            <label class="form-check-label" for="">
                                انتخاب مدیران کل
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 fv-row" id="container_selected_generals" style="display: none">
                        <select class="form-select form-select-solid" id="selected_generals" name="selected_generals[]"
                                data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-4 fv-row" id="container_all_generals" style="display: none">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_sent_generals" value="1"
                                   id="all_generals"/>
                            <label class="form-check-label" for="is_sent_generals">
                                همه
                            </label>
                        </div>
                    </div>



                    <div class="col-md-12 fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="" value="1"
                                   id="provincials"/>
                            <label class="form-check-label" for="">
                                انتخاب مدیران استانی
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 fv-row" id="container_selected_provincials" style="display: none">
                        <select class="form-select form-select-solid" id="selected_provincials" name="selected_provincials[]"
                                data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-4 fv-row" id="container_all_provincials" style="display: none">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_sent_provincials" value="1"
                                   id="all_provincials"/>
                            <label class="form-check-label" for="is_sent_provincials">
                                همه
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 fv-row">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_sent_users" value="1" />
                            <label class="form-check-label" for="is_sent_users">
                                همه کاربران
                            </label>
                        </div>
                    </div>





                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.fields.index') }}" id="add_permission_form_cancel"
                       class="btn btn-light me-3">لغو</a>
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
    <script src='https://gitcdn.ir/library/ckeditor/4.13.0/ckeditor.js' type='text/javascript'></script>

    <script>
        CKEDITOR.replace('textarea', {
            language: 'fa',
            contentsLangDirection: 'rtl',
        });
    </script>

    <script>
        $(document).ready(function () {
            if ($("#referees").is(":checked")) {
                $("#container_selected_referees").css('display', 'block');
            }
            else {
                $("#container_selected_referees").css('display', 'none');
            }
            $("#referees").change(function () {
                if ($(this).is(":checked")) {
                    $("#container_all_referees").css('display', 'block');
                    $("#container_selected_referees").css('display', 'block');
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "{{ route('admin.ajax.referees') }}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": token},
                        success: function (data) {
                            $("#selected_referees").empty();
                            $("#selected_referees").append('<option value="">لطفا انتخاب کنید</option>');
                            $.each(data.referees, function (key, value) {
                                $("#selected_referees").append('<option value=' + value.id + '>' + value.first_name + ' ' + value.last_name + '</option>');
                            });
                        },
                        error: function (data) {
                            console.log("fail");
                        }
                    });
                } else {
                    $("#container_all_referees").css('display', 'none');
                    $("#container_selected_referees").css('display', 'none');
                    $("#selected_referees").empty();
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#all_referees', function(){
            if($(this).prop('checked')){
                $('#selected_referees').attr('disabled', 'disabled');
            } else {
                $('#selected_referees').removeAttr('disabled');
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#generals").change(function () {

                if ($(this).is(":checked")) {
                    $("#container_all_generals").css('display', 'block');
                    $("#container_selected_generals").css('display', 'block');
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "{{ route('admin.ajax.generals') }}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": token},
                        success: function (data) {
                            $("#selected_generals").empty();
                            $("#selected_generals").append('<option value="">لطفا انتخاب کنید</option>');
                            $.each(data.generals, function (key, value) {
                                $("#selected_generals").append('<option value=' + value.id + '>' + value.first_name + ' ' + value.last_name + '</option>');
                            });
                        },
                        error: function (data) {
                            console.log("fail");
                        }
                    });
                } else {
                    $("#container_all_generals").css('display', 'none');
                    $("#container_selected_generals").css('display', 'none');
                    $("#selected_generals").empty();
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#all_generals', function(){
            if($(this).prop('checked')){
                $('#selected_generals').attr('disabled', 'disabled');
            } else {
                $('#selected_generals').removeAttr('disabled');
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#provincials").change(function () {

                if ($(this).is(":checked")) {
                    $("#container_all_provincials").css('display', 'block');
                    $("#container_selected_provincials").css('display', 'block');
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "{{ route('admin.ajax.provincials') }}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": token},
                        success: function (data) {
                            $("#selected_provincials").empty();
                            $("#selected_provincials").append('<option value="">لطفا انتخاب کنید</option>');
                            $.each(data.provincials, function (key, value) {
                                $("#selected_provincials").append('<option value=' + value.id + '>' + value.first_name + ' ' + value.last_name + '</option>');
                            });
                        },
                        error: function (data) {
                            console.log("fail");
                        }
                    });
                } else {
                    $("#container_all_provincials").css('display', 'none');
                    $("#container_selected_provincials").css('display', 'none');
                    $("#selected_provincials").empty();
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#all_provincials', function(){
            if($(this).prop('checked')){
                $('#selected_provincials').attr('disabled', 'disabled');
            } else {
                $('#selected_provincials').removeAttr('disabled');
            }
        });
    </script>
@endsection



