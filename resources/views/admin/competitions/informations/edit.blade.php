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
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست دوره‌های
                مسابقات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش اطلاعات کلی مسابقه</li>
    </ul>
@endsection

@section('inner_content')

    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.competitions.update', ['competition' => $competition->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش دوره {{ $competition->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title"
                               value="{{ old('title', $competition->title) }}"/>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="cities_list" class="required fs-6 fw-bold mb-2">ایجادکننده</label>
                        <select class="form-select form-select-solid" id="creator" name="creator" data-control="select2"
                                data-allow-clear="true" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                        @if ($competition->creator == $user->id) selected @endif>{{ $user->first_name . ' ' . $user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="registration_start_date"
                               class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ شروع</label>
                        <input type="text" class="form-control form-control-solid" id="registration_start_date"
                               name="registration_start_date"
                               @if (!$competition->registration_start_time)
                                   value=""
                               @else
                                   value="{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_time))->format('Y/m/d') }}"
                               @endif
                               data-jdp data-jdp-min-date="today"/>
                        <span id="calendar"></span>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="registration_finish_date"
                               class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ پایان</label>
                        <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today"
                               id="registration_finish_date" name="registration_finish_date"
                               @if (!$competition->registration_finish_time)
                                   value=""
                               @else
                                   value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_finish_time))->format('Y/m/d')}}"
                               @endif
                               data-jdp/>
                        <span id="calendar"></span>
                    </div>




                    <div class="col-md-6 fv-row">
                        <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان
                            شروع</label>
                        <div class="d-flex">
                            <div class="input-group input-group-solid">
{{--                                <span class="input-group-text">دقیقه</span>--}}
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="start_time2" name="start_time2">
                                @if($competition->registration_start_time)
                                {{ $registrationStartDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $competition->registration_start_time)->toCarbon()}}
                                @else
                                    {{ $registrationStartDateTime = null }}
                                @endif
                            @foreach ([0, 15, 30, 45] as $minute)
                                    <option value="{{ $minute }}"
                                            @if ((old('start_time2') === null && optional($registrationStartDateTime)->format('i') == $minute) || old('start_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="input-group input-group-solid">
{{--                                <span class="input-group-text">ساعت</span>--}}
                            <select class="form-select form-select-solid me-2" data-control="select2" data-hide-search="true" id="start_time1" name="start_time1">
                                @for ($hour = 0; $hour <= 23; $hour++)
                                    <option value="{{ $hour }}"
                                            @if ((old('start_time1') === null && optional($registrationStartDateTime)->format('H') == $hour) || old('start_time1') == $hour) selected @endif>{{ $hour }}</option>
                                @endfor
                            </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 fv-row">
                        <label for="finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان
                            پایان</label>
                        <div class="d-flex">
                            <div class="input-group input-group-solid">
{{--                                <span class="input-group-text">دقیقه</span>--}}
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="finish_time2" name="finish_time2">
                                    @if($competition->registration_finish_time)
                                    {{ $registrationFinishDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $competition->registration_finish_time)->toCarbon()}}
                                    @else
                                        {{ $registrationFinishDateTime = null }}
                                    @endif
                                    @foreach ([0, 15, 30, 45] as $minute)
                                        <option value="{{ $minute }}"
                                                @if ((old('finish_time2') === null && optional($registrationFinishDateTime)->format('i') == $minute) || old('finish_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-solid">
{{--                                <span class="input-group-text">ساعت</span>--}}
                                <select class="form-select form-select-solid me-2" data-control="select2" data-hide-search="true" id="finish_time1"
                                        name="finish_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}"
                                                @if ((old('finish_time1') === null && optional($registrationFinishDateTime)->format('H') == $hour) || old('finish_time1') == $hour) selected @endif>{{ $hour }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 fv-row">
                        <label for="registration_description" class="required form-label">توضیحات</label>
                        <textarea class="form-control" rows="3" id="textarea"
                                  name="registration_description">{{ old('registration_description', $competition->registration_description) }}</textarea>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="rules_description" class="required form-label">قوانین</label>
                        <textarea class="form-control" rows="3" id="textarea2"
                                  name="rules_description">{{ old('rules_description', $competition->rules_description) }}</textarea>
                    </div>


{{--                    <div class="col-md-6 fv-row">--}}
{{--                        <label for="letter_method" class="required form-label">شیوه نامه</label>--}}
{{--                        <input type="file" name="letter_method" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">--}}
{{--                        @if($letter_method)--}}
{{--                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('/upload/'. $letter_method) }}')"></div>--}}
{{--                        @else--}}
{{--                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('admin/assets/media/avatars/man.png') }}')"></div>--}}

{{--                        <div class="dropzone" id="kt_dropzonejs_example_1">--}}
{{--                            <!--begin::Message-->--}}
{{--                            <div class="dz-message needsclick">--}}
{{--                                <!--begin::Icon-->--}}
{{--                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>--}}
{{--                                <!--end::Icon-->--}}

{{--                                <!--begin::Info-->--}}
{{--                                <div class="ms-4">--}}
{{--                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload</h3>--}}
{{--                                    <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>--}}
{{--                                </div>--}}
{{--                                <!--end::Info-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-text"> فایل های مجاز: pdf.</div>--}}
{{--                        @endif--}}

{{--                    </div>--}}

                    <div class="col-md-6 fv-row">
                        <div class="d-flex d-inline-block gap-10">
                            <label for="letter_method" class="required form-label">شیوه نامه</label>
                            <div class="form-text my-auto"> فایل‌های مجاز: pdf.</div>
                        </div>
                        <br>
{{--                        <div class="dropzone" id="kt_dropzonejs_example_1"></div>--}}
                        @if($letter_method)
                            <input type="file" name="letter_method" class="form-control form-control-solid mt-4" accept=".pdf">
{{--                            <div class="form-text"> فایل‌های مجاز: pdf.</div>--}}
                        <br>
                            <a href="{{ url('upload/'.$letter_method) }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary btn-hover-rise" target="_blank">
                                <i class="bi bi-download"></i>  دانلود فایل</a>
                        @else
                        <input type="file" name="letter_method" class="form-control form-control-solid" accept=".pdf">

                        @endif
                    </div>
                    <div class="col-md-1 fv-row"></div>
                    <div class="col-md-4 fv-row">
                            <div class="d-flex d-inline-block gap-10">
                                <label for="banner" class="required form-label">بنر</label>
                                <div class="form-text"> فایل های مجاز: png, jpg, jpeg.</div>
                            </div>
        {{--                        @if($banner)--}}
        {{--                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('/upload/'. $letter_method) }}')"></div>--}}
        {{--                        @else--}}
        {{--                            <input type="file" name="banner" accept=".jpeg, .png, .jpg, .gif, .svg, .jfif">--}}
        {{--                            <div class="form-text"> فایل‌های مجاز: jpeg, png, jpg, gif, svg, jfif.</div>--}}
        {{--                        @endif--}}
                                <div class="image-input image-input-outline mt-4" data-kt-image-input="true" style="background-image: url('{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}')">
                                    @if($banner)
                                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset('/upload/'. $banner) }}')"></div>
                                    @else
                                        <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}')"></div>
                                    @endif
                                    <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تغییر بنر">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--begin::Inputs-->
                                        <input type="file" name="banner" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                        <input type="hidden" name="avatar_remove">
                                    </label>
                                </div>

                    </div>

                    <div class="col-md-6 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            @if($competition->is_active == 1)
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       value="1" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       value="1">
                            @endif
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
                        <span class="indicator-label">مرحله بعد</span>
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
            contentsLangDirection: 'rtl',
        });
    </script>

    <script>
        CKEDITOR.replace('textarea2', {
            language: 'fa',
            contentsLangDirection: 'rtl',
        });
    </script>

    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>

    <script>
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            // url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            url: "{{ url('/upload') }}",
            paramName: "letter_method", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    </script>
{{--    <script>--}}
{{--        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {--}}
{{--            url: "{{ url('/upload') }}",--}}
{{--            paramName: "letter_method",--}}
{{--            maxFiles: 1,--}}
{{--            maxFilesize: 10,--}}
{{--            addRemoveLinks: true,--}}
{{--            acceptedFiles: ".pdf",--}}
{{--            init: function () {--}}
{{--                this.on("sending", function(file, xhr, formData) {--}}
{{--                    // اضافه کردن توکن CSRF به درخواست--}}
{{--                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');--}}
{{--                    formData.append('_token', csrfToken);--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
