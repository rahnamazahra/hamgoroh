@extends('layouts.admin.master')

@section('title', 'دوره‌ها')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">دوره‌ها</h1>
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
        <li class="breadcrumb-item text-dark">ویرایش دوره</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.competitions.update', ['competition' => $competition->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش دوره {{ $competition->title }}</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-6 fv-row">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $competition->title) }}" />
                    </div>
{{--                    <div class="col-md-6 fv-row">--}}
{{--                        <label for="registration_start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان شروع</label>--}}
{{--                        <input type="text"  class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_start_time" name="registration_start_time"--}}
{{--                               @if (!$competition->registration_start_time)--}}
{{--                                   value=""--}}
{{--                               @else--}}
{{--                                   value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_time))->format('Y/m/d H:i:s')}}"--}}
{{--                               @endif--}}
{{--                               data-jdp/>--}}
{{--                        <span id="calendar"></span>--}}
{{--                    </div>--}}
                    <div class="col-md-6 fv-row">
                        <label for="registration_start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان شروع</label>
                        <input type="text" class="form-control form-control-solid" id="registration_start_time" name="registration_start_time"
                               @if (!$competition->registration_start_time)
                                   value=""
                               @else
                                   value="{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_time))->format('Y/m/d H:i:s') }}"
                               @endif
                               data-jdp data-jdp-min-date="today" data-jdp-time-picker="true" />
                        <span id="calendar"></span>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="registration_finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان پایان</label>
                        <input type="text"  class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_finish_time" name="registration_finish_time"
                               @if (!$competition->registration_finish_time)
                                   value=""
                               @else
                                   value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_finish_time))->format('Y/m/d H:i:s')}}"
                               @endif
                               data-jdp/>
                        <span id="calendar"></span>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="registration_description" class="required form-label">توضیحات</label>
                        <textarea class="form-control form-control-solid" name="registration_description">{{ old('registration_description', $competition->registration_description) }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="rules_description" class="required form-label">قوانین</label>
                        <textarea class="form-control form-control-solid" name="rules_description">{{ old('rules_description', $competition->rules_description) }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="letter_method" class="required form-label">شیوه نامه</label>
                        <textarea class="form-control form-control-solid" name="letter_method">{{ old('letter_method', $competition->letter_method) }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="banner" class="required form-label">بنر</label>
                        <textarea class="form-control form-control-solid" name="banner">{{ old('banner', $competition->banner) }}</textarea>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label for="cities_list" class="required fs-6 fw-bold mb-2">ایجادکننده</label>
                        <select class="form-select form-select-solid" id="creator" name="creator" data-control="select2" data-allow-clear="true" data-placeholder="لطفا را انتخاب کنید">
                            <option></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($competition->creator == $user->id) selected @endif>{{ $user->first_name . ' ' . $user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label>وضعیت</label>
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-check form-switch">
                            @if($competition->is_active == 1)
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                            @endif
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>




                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.competitions.index') }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
{{--<script type="text/javascript">--}}
{{--    jalaliDatepicker.startWatch();--}}
{{--</script>--}}
<script type="text/javascript">
    jalaliDatepicker.startWatch();

    jalaliDatepicker.attachDatepicker(document.getElementById('your-datepicker-element'), {
        time: true,
        observer: true,
        formatter: (inputValue, date, instance) => {

            const formattedDate = moment(date).format('YYYY-MM-DD HH:mm:ss');
            return formattedDate;
        }
    });
</script>

@endsection