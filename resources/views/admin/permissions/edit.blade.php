@extends('layouts.admin.master')

@section('title', 'دسترسی‌ها')

@section('content')
    @include('admin.toast.errortoast')
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="PATCH" action="{{ route('admin.permissions.update', 'permission' => $permission->id) }}">
                <div class="row g-9 mb-8">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $permission->title) }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">اسلاگ</label>
                        <input type="text" class="form-control form-control-solid" name="slug" value="{{ old('slug', $permission->slug) }}" />
                    </div>
                    <div class="col-md-6 fv-row">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="roles" class="required d-flex align-items-center fs-6 fw-bold mb-2">‌نقش‌ها</label>
                                <select class="form-select form-select-solid" name="roles" data-control="select2" data-placeholder="لطفا انتخاب کنید" data-allow-clear="true" multiple="multiple">
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @selected($user->roles()->wherePivot('role_id', $role->id)->exists())>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label for="title" class="required form-label">توضیحات</label>
                        <input type="text" class="form-control form-control-solid" name="description" value="{{ old('description', $permission->description) }}" />
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
