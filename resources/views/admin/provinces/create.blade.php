@extends('layouts.admin.master')
@section('title', 'ویرایش استان')
@section('content')
@can('provinces-update')
    <div class="card">
        <div class="card-body">
            <div class="mb-13 text-center">
                <h1 class="mb-3">ایجاد استان جدید</h1>
            </div>
            @include('admin.errors.error_message')
            <form class="form" role="form" autocomplete="off" id="add_province_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-body">
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required d-flex align-items-center fs-6 fw-bold mb-2">نام استان</label>
                        <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{ old('title') }}"/>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-submit w-100 mb-5">
                        <span class="indicator-label">ثبت</span>
                        <span class="indicator-progress">لطفا چندلحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <a href="{{ rout('admin.users.index')}}" type="button" class="btn btn-light">برگشت</button>
                </div>
            </form>
        </div>
    </div>
@endcan
@endsection

