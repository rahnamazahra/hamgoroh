@extends('admin.competitions.master')

@section('inner_breadcrumb')
<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">ویرایش زیررشته‌ها</h1>
<span class="h-20px border-gray-300 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست دوره‌های مسابقات</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.competitions.edit', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">اطلاعات کلی مسابقه</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.groups.index', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">سبد و رشته‌ها</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.challenges.create', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">تعریف زیررشته‌ها</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">ویرایش زیررشته‌ها</li>
</ul>
@endsection

@section('inner_content')
<div class="card shadow-sm">
    <form method="POST" action="{{ route('admin.challenges.update', ['competition' => $competition->id]) }}">
        @method('PATCH')
        @csrf
        <div class="card-body">
            @forelse ($fields as $f)
            @php
                $field = App\Models\Field::with('challenges')->find($f->field_id);
            @endphp
                <div class="row g-9">
                    <span class="fs-3 fw-bold">{{ $field->title }}</span>
                </div>
                @foreach ($field->challenges as $challenge)
                    <div class="row g-9 my-2">
                        <div class="col-md-4 fv-row">
                            <label for="age_id" class="required form-label">بازه سنی</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="age_id" name="age_id">
                                <option></option>
                                @foreach ($competition->ages as $age)
                                    <option value="{{ $age->id }}" @selected($challenge->age_id == $age->id)>{{ $age->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label for="gender" class="required form-label">جنسیت</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="gender" name="gender">
                                <option></option>
                                <option value="-1" @selected($challenge->gender == '-1')>همه</option>
                                <option value="0"  @selected($challenge->gender == '0')>خانم‌ها</option>
                                <option value="1"  @selected($challenge->gender == '1')>آقایان</option>
                            </select>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label for="nationality" class="required form-label">ملیت</label>
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="لطفا انتخاب کنید" id="nationality" name="nationality">
                                <option></option>
                                <option value="-1" @selected($challenge->nationality == '-1')>همه</option>
                                <option value="0"  @selected($challenge->nationality == '0')>ایرانی</option>
                                <option value="1"  @selected($challenge->nationality == '1')>خارجی</option>
                            </select>
                        </div>
                        <div class="col-md-2 fv-row">
                            <button class="btn btn-sm btn-light-danger mt-3 mt-md-8" name="btn_delete_item" data-id="{{ $challenge->id }}" data-url="{{ route('admin.challenges.delete', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}">
                                <i class="la la-trash-o"></i>حذف
                            </button>
                        </div>
                    </div>
                @endforeach
                <div class="separator my-10"></div>
            @empty
            jiluikjhkjhuyouyhui
            @endforelse
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.competitions.index') }}" id="update_challenge_form_cancel" class="btn btn-light me-3">لغو</a>
                <button type="submit" id="update_challenge_form_submit" class="btn btn-primary">
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
