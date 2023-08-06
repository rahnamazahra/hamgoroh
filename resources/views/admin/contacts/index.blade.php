@extends('layouts.admin.master')

@section('title', 'تماس باما')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">تماس باما</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">تماس باما</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        @can('setting-index')
            @if (\App\Models\Contact::count() === 0)
                <form method="POST" action="{{ route('admin.contacts.store') }}">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">ایجاد تماس باما</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-9">

                            <div class="col-md-6 fv-row">
                                <label for="address" class="required form-label">آدرس</label>
                                <input type="text" class="form-control form-control-solid" id="address" name="address"
                                       value="{{ old('address') }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="phone_number" class="required form-label">شماره تلفن</label>
                                <input type="number" class="form-control form-control-solid" id="phone_number"
                                       name="phone_number" value="{{ old('phone_number') }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="postal_code" class=" form-label">کدپستی</label>
                                <input type="text" class="form-control form-control-solid" id="postal_code"
                                       name="postal_code" value="{{ old('postal_code') }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="email" class=" form-label">ایمیل</label>
                                <input type="email" class="form-control form-control-solid" id="email" name="email"
                                       value="{{ old('email') }}"/>
                            </div>

                            <div class="col-md-12 fv-row">
                                <label for="body" class="form-label">متن</label>
                                <textarea class="form-control" rows="3" id="textarea"
                                          name="body">{{ old('body') }}</textarea>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="telegram" class=" form-label">لینک تلگرام</label>
                                <input type="text" class="form-control form-control-solid" id="telegram" name="telegram"
                                       value="{{ old('telegram') }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="whatsapp" class=" form-label">لینک وانساپ</label>
                                <input type="text" class="form-control form-control-solid" id="whatsapp" name="whatsapp"
                                       value="{{ old('whatsapp') }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="instagram" class=" form-label">لینک اینستاگرام</label>
                                <input type="text" class="form-control form-control-solid" id="instagram"
                                       name="instagram" value="{{ old('instagram') }}"/>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.abouts.index') }}" id="add_permission_form_cancel"
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

            @else
                <form method="POST" action="{{ route('admin.contacts.update', ['contact' => $contact->id]) }}"
                      enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="card-header">
                        <div class="card-title">ویرایش تماس باما</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-9">

                            <div class="col-md-6 fv-row">
                                <label for="address" class="required form-label">آدرس</label>
                                <textarea class="form-control form-control-solid" id="address"
                                          name="address">{{ old('address', $contact->address) }}</textarea>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="phone_number" class="required form-label">شماره تلفن</label>
                                <input type="text" class="form-control form-control-solid" id="phone_number"
                                       name="phone_number" value="{{ old('phone_number', $contact->phone_number) }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="postal_code" class=" form-label">کدپستی</label>
                                <input type="text" class="form-control form-control-solid" id="postal_code"
                                       name="postal_code" value="{{ old('postal_code', $contact->postal_code) }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="email" class=" form-label">ایمیل</label>
                                <input type="email" class="form-control form-control-solid" id="email" name="email"
                                       value="{{ old('email', $contact->email) }}"/>
                            </div>

                            <div class="col-md-12 fv-row">
                                <label for="body" class="form-label">متن</label>
                                <textarea class="form-control" rows="3" id="textarea2"
                                          name="body">{{ old('body', $contact->body) }}</textarea>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="telegram" class=" form-label">لینک تلگرام</label>
                                <input type="text" class="form-control form-control-solid" id="telegram" name="telegram"
                                       value="{{ old('telegram', $contact->telegram) }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="whatsapp" class=" form-label">لینک وانساپ</label>
                                <input type="text" class="form-control form-control-solid" id="whatsapp" name="whatsapp"
                                       value="{{ old('whatsapp', $contact->whatsapp) }}"/>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="instagram" class=" form-label">لینک اینستاگرام</label>
                                <input type="text" class="form-control form-control-solid" id="instagram"
                                       name="instagram"
                                       value="{{ old('instagram', $contact->instagram) }}"/>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.contacts.index') }}" id="update_permission_form_cancel"
                               class="btn btn-light me-3">لغو</a>
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
        @endcan
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
        CKEDITOR.replace('textarea2', {
            language: 'fa',
            contentsLangDirection: 'rtl',
        });
    </script>
@endsection
