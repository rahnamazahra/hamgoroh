@extends('layouts.admin.master')

@section('title', 'زمان‌بندی')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">زمان‌بندی</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.schedules.index', ['step' => $step->id]) }}" class="text-muted text-hover-primary">زمان‌بندی</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">ویرایش زمان‌بندی</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <form method="POST" action="{{ route('admin.schedules.update', ['schedule' => $schedule->id, 'step' => $step->id]) }}">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <div class="card-title">ویرایش زمان‌بندی </div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 fv-row">
                        <label for="date"
                               class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ</label>
                        <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today"
                               id="date" name="date" value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($schedule->from_time))->format('Y/m/d')}}" data-jdp/>
                        <span id="calendar"></span>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان
                            شروع</label>
                        <div class="d-flex">
                            <div class="input-group input-group-solid">
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="start_time2" name="start_time2">
                                    {{ $startDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $schedule->from_time)->toCarbon()}}
                                    @foreach ([0, 15, 30, 45] as $minute)
                                        <option value="{{ $minute }}"
                                                @if ((old('start_time2') === null && optional($startDateTime)->format('i') == $minute) || old('start_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-solid">
                                <select class="form-select form-select-solid me-2" data-control="select2" data-hide-search="true" id="start_time1" name="start_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}"
                                                @if ((old('start_time1') === null && optional($startDateTime)->format('H') == $hour) || old('start_time1') == $hour) selected @endif>{{ $hour }}</option>
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
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="finish_time2" name="finish_time2">
                                    {{ $finishDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $schedule->to_time)->toCarbon()}}
                                    @foreach ([0, 15, 30, 45] as $minute)
                                        <option value="{{ $minute }}"
                                                @if ((old('finish_time2') === null && optional($finishDateTime)->format('i') == $minute) || old('finish_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-solid">
                                <select class="form-select form-select-solid me-2" data-control="select2" data-hide-search="true" id="finish_time1"
                                        name="finish_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}"
                                                @if ((old('finish_time1') === null && optional($finishDateTime)->format('H') == $hour) || old('finish_time1') == $hour) selected @endif>{{ $hour }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 fv-row">
                        <label for="roles" class="required form-label">رزرو توسط</label>
                        <select class="form-select form-select-solid" id="user_id" name="user_id" data-control="select2" data-placeholder="لطفا انتخاب کنید">
                            <option></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id}}" @selected($schedule->user_id == $user->id)>{{ $user->first_name . ' ' . $user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.schedules.index', ['step' => $step->id]) }}" id="add_permission_form_cancel" class="btn btn-light me-3">لغو</a>
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
@endsection
