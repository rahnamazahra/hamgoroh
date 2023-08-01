@extends('layouts.admin.master')

@section('title', 'اخبار')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">اخبار</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.news.index') }}" class="text-muted text-hover-primary">اخبار</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش خبر</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.news.update', ['news' => $news->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش خبر {{ $news->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                        <div class="col-md-6 fv-row">
                            <label for="image" class="form-label">تصویر</label>
                            <input type="text" class="form-control form-control-solid" id="image" name="image" value="{{ old('image', $news->imag) }}" />
                        </div>

                    <div class="col-md-6 fv-row">
                        <label for="title" class="form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" id="title" name="title" value="{{ old('title', $news->title) }}" />
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="sub_title" class="form-label">زیرعنوان</label>
                        <textarea class="form-control form-control-solid" id="sub_title" name="sub_title">{{ old('sub_title', $news->sub_title) }}</textarea>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="preview" class="form-label">پیش نمایش</label>
                        <textarea class="form-control form-control-solid" id="preview" name="preview">{{ old('preview', $news->preview) }}</textarea>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="body" class="form-label">متن</label>
                        <textarea class="form-control" rows="3" id="textarea" name="body">{{ old('body', $news->body) }}</textarea>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="news_category" class="form-label">‌تگ‌ها</label>
                        <select class="form-select form-select-solid" id="news_category" name="news_category[]" data-control="select2" data-placeholder="لطفا انتخاب کنید" multiple="multiple">
                            <option></option>
                            @foreach($news_category as $item)
                                <option value="{{ $item->id }}" @selected((old('news_category') and in_array($item->id, old('news_category'))) or $news->categories->contains($item->id))>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label>وضعیت انتشار</label>
                        <input type="hidden" name="is_published" value="0">
                        <div class="form-check form-switch">
                            @if($news->is_published == 1)
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                       value="1" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                       value="1">
                            @endif
                            <label class="form-check-label" for="is_published">فعال</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.news.index') }}" id="update_permission_form_cancel" class="btn btn-light me-3">لغو</a>
                    <button type="submit" id="update_permission_form_submit" class="btn btn-primary">
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
