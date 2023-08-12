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
        <li class="breadcrumb-item text-muted">
            <a href="" class="text-muted text-hover-primary">مدیریت دوره</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark"> زمان‌بندی </li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm col-xl-12">
        <form method="POST" action="{{ route('admin.challenges.schedule.store', ['challenge' => $challenge->id]) }}" autocomplete="off">
            @csrf
            <div class="card-header">
                <div class="card-title">زمان‌بندی</div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-12 row my-5">
                        <div class="col-md-6 fv-row">
                            <label for="result_start_time" class="required form-label">تاریخ شروع نمایش نمرات</label>
                            <input type="txt" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="result_start_time" name="result_start_time"
                            @if (!$challenge->result_start_time)
                              value=""
                            @else
                                value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($challenge->result_start_time))->format('Y/m/d')}}"
                            @endif
                           />
                            <span id="calendar"></span>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="result_finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2"> تاریخ پایان نمایش نمرات</label>
                            <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="result_finish_time" name="result_finish_time"
                            @if (!$challenge->result_finish_time)
                                value=""
                            @else
                                value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($challenge->result_finish_time))->format('Y/m/d')}}"
                            @endif
                            />
                            <span id="calendar"></span>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-6 fv-row">
                            <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان شروع نمایش نمرات</label>
                            <div class="d-flex">
                                <select class="form-select form-select-solid" id="start_time2" name="start_time2">
                                    @if($challenge->result_start_time)
                                        {{ $resultStartDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $challenge->result_start_time)->toCarbon()}}
                                    @else
                                        {{ $resultStartDateTime = null }}
                                    @endif
                                    @foreach ([0, 15, 30, 45] as $minute)
                                        <option value="{{ $minute }}" @if ((old('start_time2') === null && optional($resultStartDateTime)->format('i') == $minute) || old('start_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endforeach
                                </select>
                                <select class="form-select form-select-solid me-2" id="start_time1" name="start_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}" @if ((old('start_time2') === null && optional($resultStartDateTime)->format('H') == $hour) || old('finish_time1') == $hour) selected @endif>{{ $hour }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان پایان نمایش نمرات</label>
                            <div class="d-flex">
                                <select class="form-select form-select-solid" id="finish_time2" name="finish_time2">
                                   @if($challenge->result_finish_time)
                                        {{ $resultFinishDateTime = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d H:i:s', $challenge->result_finish_time)->toCarbon()}}
                                    @else
                                        {{ $resultFinishDateTime = null }}
                                    @endif
                                    @foreach ([0, 15, 30, 45] as $minute)
                                        <option value="{{ $minute }}" @if ((old('finish_time2') === null && optional($resultFinishDateTime)->format('i') == $minute) || old('finish_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endforeach
                                </select>
                                <select class="form-select form-select-solid me-2" id="finish_time1" name="finish_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}" @if ((old('finish_time2') === null && optional($resultFinishDateTime)->format('H') == $hour) || old('finish_time2') == $hour) selected @endif>{{ $hour }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  <div class="row g-9 my-10">
                    <div class="col-md-12 row my-5">
                        <div class="col-md-6 fv-row">
                            <label for="registration_start_date" class="required form-label">تاریخ شروع ثبت‌نام</label>
                            <input type="txt" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_start_date" name="registration_start_date"
                            @if (!$competition->registration_start_date)
                                value=""
                            @else
                                value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_date))->format('Y/m/d')}}"
                            @endif
                            />
                            <span id="calendar"></span>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="registration_finish_date" class="required d-flex align-items-center fs-6 fw-bold mb-2">تاریخ پایان ثبت‌نام</label>
                            <input type="text" class="form-control form-control-solid" data-jdp data-jdp-min-date="today" id="registration_finish_date" name="registration_finish_date"
                            @if (!$competition->registration_finish_date)
                                value=""
                            @else
                                value="{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_finish_date))->format('Y/m/d')}}"
                            @endif
                           />
                            <span id="calendar"></span>
                        </div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-6 fv-row">
                            <label for="start_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان شروع ثبت‌نام</label>
                            <div class="d-flex">
                                <select class="form-select form-select-solid" id="start_time2" name="start_time2">
                                    @for ($minute = 0; $minute <= 45; $minute += 15)
                                        <option value="{{ $minute }}" @if (old('start_time2') == $minute) selected @endif> {{ sprintf("%02d", $minute) }} </option>
                                    @endfor
                                </select>
                                <select class="form-select form-select-solid me-2" id="start_time1" name="start_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}" @if (old('start_time1') == $hour) selected @endif> {{ $hour }} </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="finish_time" class="required d-flex align-items-center fs-6 fw-bold mb-2">زمان پایان ‌ثبت‌نام</label>
                            <div class="d-flex">
                                <select class="form-select form-select-solid" id="finish_time2" name="finish_time2">
                                    @for ($minute = 0; $minute <= 45; $minute += 15)
                                        <option value="{{ $minute }}" @if (old('finish_time2') == $minute) selected @endif>{{ sprintf("%02d", $minute) }}</option>
                                    @endfor
                                </select>
                                <select class="form-select form-select-solid me-2" id="finish_time1" name="finish_time1">
                                    @for ($hour = 0; $hour <= 23; $hour++)
                                        <option value="{{ $hour }}" @if (old('finish_time1') == $hour) selected @endif> {{ $hour }} </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>  --}}
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.competitions.show', ['competition' => $competition->id]) }}" class="btn btn-light me-3">لغو</a>
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
