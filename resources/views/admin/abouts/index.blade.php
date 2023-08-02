@extends('layouts.admin.master')

@section('title', 'اخبار')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">درباره ما</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">درباره ما</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
    @if (\App\Models\About::count() === 0)
            <form method="POST" action="{{ route('admin.abouts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div class="card-title">ایجاد درباره ما</div>
                </div>
                <div class="card-body">
                    <div class="row g-9">

                        <div class="col-md-12 fv-row">
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('admin/assets/media/avatars/man.png') }}')">
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}')"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تغییر عکس">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                    </svg>
                                </span>
                                    <!--begin::Inputs-->
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                    <input type="hidden" name="avatar_remove">
                                </label>
                            </div>
                            <div class="form-text"> فایل های مجاز: jpeg, png, jpg, gif, svg, jfif.</div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="preview" class="form-label">پیش نمایش</label>
                            <textarea class="form-control form-control-solid" id="preview" name="preview">{{ old('preview') }}</textarea>
                        </div>

                        <div class="col-md-12 fv-row">
                            <label for="body" class="required form-label">متن</label>
                            <textarea class="form-control" rows="3" id="textarea" name="body">{{ old('body') }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.abouts.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                        <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                            <span class="indicator-label">ثبت</span>
                            <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    </div>
                </div>
            </form>

    @else

            <form method="POST" action="{{ route('admin.abouts.update', ['about' => $about->id]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="card-header">
                    <div class="card-title">ویرایش درباره ما </div>
                </div>
                <div class="card-body">
                    <div class="row g-9">

                        <div class="col-md-12 fv-row">
                            @php
                                $image = \App\Models\File::where('fileable_id', $about->id)->pluck('path')->first();
                            @endphp
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                @if($image)
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('/upload/'. $image) }}')"></div>
                                @else
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}')"></div>
                                @endif
                                <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تغییر تصویر">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                    </svg>
                                </span>
                                    <!--begin::Inputs-->
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                    <input type="hidden" name="avatar_remove">
                                </label>
                            </div>
                            <div class="form-text"> فایل های مجاز: png, jpg, jpeg.</div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label for="preview" class="form-label">پیش نمایش</label>
                            <textarea class="form-control form-control-solid" id="preview" name="preview">{{ old('preview', $about->preview) }}</textarea>
                        </div>

                        <div class="col-md-12 fv-row">
                            <label for="body" class="form-label">متن</label>
                            <textarea class="form-control" rows="3" id="textarea" name="body">{{ old('body', $about->body) }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.abouts.index') }}" id="update_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                        <button type="submit" id="update_permission_form_submit" class="btn btn-primary">
                            <span class="indicator-label">ثبت</span>
                            <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    </div>
                </div>
            </form>

    @endif
    </div>
@endsection

@section('custom-scripts')
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
@endsection
