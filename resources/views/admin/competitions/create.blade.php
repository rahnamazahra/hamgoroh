@extends('layouts.admin.master')

@section('title', 'دوره‌ها')
{{--@section('custom-style')--}}
{{--    <link rel="stylesheet" href="{{ asset('ckeditor/skins/moono/editor.css') }}">--}}
{{--@endsection--}}

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ایجاد دوره</h1>
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
        <li class="breadcrumb-item text-dark">ایجاد دوره</li>
    </ul>
@endsection

@section('content')
    {{-- @include('admin.errors.error-message') --}}
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.competitions.store') }}">
            @csrf
            <div class="card-header">
                <div class="card-title">ایجاد دوره</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title"
                               value="{{ old('title') }}"/>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="creator" class="required form-label">ایجادکننده</label>
                        <select class="form-select form-select-solid" name="creator" data-control="select2"
                                data-placeholder="لطفا انتخاب کنید">
                            @foreach($users as $user)
                                <option value='{{ $user->id }}'>{{ $user->first_name . ' ' . $user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="registration_start_date" class="required form-label">تاریخ شروع</label>
                        <input type="txt" class="form-control form-control-solid" data-jdp data-jdp-min-date="today"
                               id="registration_start_date" name="registration_start_date"
                               value="{{ old('registration_start_date') }}"/>
                        <span id="calendar"></span>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="registration_finish_date"
                               class="required d-flex align-items-center fs-6 fw-bold mb-2"> تاریخ پایان</label>
                        <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today"
                               id="registration_finish_date" name="registration_finish_date"
                               value="{{ old('registration_finish_date') }}"/>
                        <span id="calendar"></span>
                    </div>


{{--                    <div class="col-md-6 fv-row">--}}
{{--                        <label for="start_time1"--}}
{{--                               class="required d-flex align-items-center fs-6 fw-bold mb-2"> ساعت شروع</label>--}}
{{--                        <input type="number" class="form-control form-control-solid"--}}
{{--                               id="start_time1" name="start_time1"--}}
{{--                               value="{{ old('start_time1') }}"/>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 fv-row">--}}
{{--                        <label for="start_time2"--}}
{{--                               class="required d-flex align-items-center fs-6 fw-bold mb-2">دقیقه شروع</label>--}}
{{--                        <input type="number" class="form-control form-control-solid"--}}
{{--                               id="start_time2" name="start_time2"--}}
{{--                               value="{{ old('start_time2') }}"/>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6 fv-row">--}}
{{--                        <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">ساعت و دقیقه شروع</label>--}}
{{--                        <input type="time" class="form-control form-control-solid" id="start_time" name="start_time"--}}
{{--                               value="{{ old('start_time') }}" step="1">--}}
{{--                    </div>--}}

                    <div class="col-md-6 fv-row">
                        <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان شروع</label>
                        <div class="d-flex">
                            <select class="form-select form-select-solid" id="start_time2" name="start_time2">
                                @for ($minute = 0; $minute <= 45; $minute += 15)
                                    <option value="{{ $minute }}" @if (old('start_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                @endfor
                            </select>
                            <select class="form-select form-select-solid me-2" id="start_time1" name="start_time1">
                                @for ($hour = 0; $hour <= 23; $hour++)
                                    <option value="{{ $hour }}" @if (old('start_time1') == $hour) selected @endif>{{ $hour }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6 fv-row">
                        <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان پایان</label>
                        <div class="d-flex">
                            <select class="form-select form-select-solid" id="start_time2" name="start_time2">
                                @for ($minute = 0; $minute <= 45; $minute += 15)
                                    <option value="{{ $minute }}" @if (old('start_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                @endfor
                            </select>
                            <select class="form-select form-select-solid me-2" id="start_time1" name="start_time1">
                                @for ($hour = 0; $hour <= 23; $hour++)
                                    <option value="{{ $hour }}" @if (old('start_time1') == $hour) selected @endif>{{ $hour }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>




                    <div class="col-md-6 fv-row">
                        <label for="registration_description" class="required form-label">توضیحات</label>
{{--                        <textarea class="form-control form-control-solid" name="registration_description">{{ old('registration_description') }}</textarea>--}}
                        <textarea class="form-control" rows="3" id="textarea" name="registration_description">{{ old('registration_description') }}</textarea>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="rules_description" class="required form-label">قوانین</label>
{{--                        <textarea class="form-control form-control-solid" name="rules_description">{{ old('rules_description') }}</textarea>--}}
                        <textarea class="form-control" rows="3" id="textarea2" name="rules_description">{{ old('rules_description') }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="letter_method" class="required form-label">شیوه نامه</label>
                        <textarea class="form-control form-control-solid"
                                  name="letter_method">{{ old('letter_method') }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="banner" class="required form-label">بنر</label>
                        <textarea class="form-control form-control-solid" name="banner">{{ old('banner') }}</textarea>
                    </div>


                    <div class="col-md-12 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   @if(old('is_active') == 1) checked @endif>
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.competitions.index') }}" id="add_permission_form_cancel"
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
    <script>
        jalaliDatepicker.startWatch();
    </script>

    <script src='https://gitcdn.ir/library/ckeditor/4.13.0/ckeditor.js' type='text/javascript'></script>

    <script>
        CKEDITOR.replace('textarea', {
            language: 'fa',
            contentsLangDirection : 'rtl',
        });
    </script>

    <script>
        CKEDITOR.replace('textarea2', {
            language: 'fa',
            contentsLangDirection : 'rtl',
        });
    </script>
{{--    <script src="https://gitcdn.ir/library/ckeditor/5/ckeditor5-build-classic/ckeditor.js"></script>--}}
{{--    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>--}}
{{--    <script src="{{ asset('admin/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>--}}
{{--    <script src="{{ asset('admin/assets/plugins/custom/')}}"></script>--}}
{{--    <script src="{{ asset('admin/assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js')}}"></script>--}}
{{--    <script src="{{ asset('admin/assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js')}}"></script>--}}
{{--    <script src="{{ asset('admin/assets/plugins/custom/ckeditor/ckeditor-document.bundle.js')}}"></script>--}}

{{--    <script>--}}
{{--        InlineEditor--}}
{{--            .create(document.querySelector('#kt_docs_ckeditor_inline'))--}}
{{--            .then(editor => {--}}
{{--                console.log(editor);--}}
{{--            })--}}
{{--            .catch(error => {--}}
{{--                console.error(error);--}}
{{--            });--}}
{{--    </script>--}}

{{--<script src="./node_modules/ckeditor4/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        CKEDITOR.replace( 'editor' );--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        DecoupledEditor--}}
{{--            .create(document.querySelector('#kt_docs_ckeditor_document'))--}}
{{--            .then(editor => {--}}
{{--                const toolbarContainer = document.querySelector( '#kt_docs_ckeditor_document_toolbar' );--}}

{{--                toolbarContainer.appendChild( editor.ui.view.toolbar.element );--}}
{{--            })--}}
{{--            .catch(error => {--}}
{{--                console.error(error);--}}
{{--            });--}}
{{--    </script>--}}

{{--    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}
{{--    <script>--}}
{{--        CKEDITOR.replace('editor');--}}
{{--    </script>--}}
@endsection
