@extends('layouts.admin.master')

@section('title', 'داوری')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">داوری</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.referee.index') }}" class="text-muted text-hover-primary">مراحل</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">نمره دهی</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm my-5">
        <div class="card-header">
            <div class="card-title">
                <div class="d-flex justify-content-between gap-lg-15">

                    @if($examinerUser)
                        @php
                            $no_examiner = false;
                        @endphp
                        <div>
                            <span class="text-gray-600 fs-5">نام کاربر: </span>
                            {{ $examinerUser->participant->user->fullName() }}
                        </div>
                        <div>
                            <span class="text-gray-600 fs-5">کدملی: </span>
                            {{ $examinerUser->participant->user->national_code }}
                        </div>
                        <div>
                            <span class="text-gray-600 fs-5">استان: </span>
                            {{ $examinerUser->participant->user->province->title }}
                        </div>
                    @else
                        @php
                            $no_examiner = true;
                        @endphp
                    @endif
                </div>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.referee.show', ['step' => $step->id]) }}" class="btn btn-sm btn-primary">لیست
                    کاربران</a>
            </div>
        </div>
        <div class="card-body">
            <div>
                @if($no_examiner == true)
                    <span>کاربری وجود ندارد</span>
                @else
                    <div class="row g-9">
                        <div class="col-md-6 fv-row">
                            <form method="POST" action="{{ route('admin.referee.store', ['step' => $step->id]) }}">
                                @csrf
                                <div class="row g-9">
                                    <input type="hidden" name="examiner_id" class="form-control"
                                           value="{{$examinerUser->id}}"/>
                                    @foreach($criteria_result['criteria'] as $item)
                                        @php
                                            $criteria = \App\Models\Criteria::find($item);
                                            $point = \App\Models\Evaluation::where('step_id', $step->id)->where('criteria_id', $criteria->id)->first()->point;
                                        @endphp
                                        <div class="col-md-3 fv-row">
                                            <label for="title" class="required form-label">
                                                نمره {{ $criteria->title }}</label>
                                            <div class="d-inline-flex flex-center gap-4">
                                                <input type="number" class="form-control form-control-solid"
                                                       name="score[]"
                                                       value="{{ old('score') }}"/>
                                                <span>از {{$point}} نمره </span>
                                            </div>
                                            <input type="hidden" name="criteria_id[]" class="form-control"
                                                   value="{{ $criteria->id }}">
                                        </div>
                                        <div class="col-md-9"></div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-between my-8">
                                    <button type="submit" id="add_permission_form_submit" class="btn btn-primary">
                                        <span class="indicator-label">ثبت و کاربر بعدی</span>
                                        <span class="indicator-progress">لطفا چند لحظه صبر کنید ...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6 fv-row">
                            @switch($step->type)
                                @case('text')

                                    @break

                            @endswitch
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card shadow-sm my-5">
        <div class="card-header">
            <div class="card-title">
                <span>لیست 10 کاربر اخیر</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="permissions_list" class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">نام کاربر</th>
                        <th class="text-center">کدملی</th>
                        <th class="text-center">نمره</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($last_examiners as $key => $last_examiner)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            @php
                                $examiner = \App\Models\Examiner::find($last_examiner['examiner_id']);
                            @endphp
                            <td class="text-center">{{ $examiner->participant->user->fullName() }}</td>
                            <td class="text-center">{{ $examiner->participant->user->national_code }}</td>
                            <td class="text-center">
                                @foreach($last_examiner['scores'] as $score)
                                    <div>
                                        <span>{{ \App\Models\Criteria::find($score['criteria_id'])->title }} : </span>
                                        {{ $score['score'] }}
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">‌آیتمی برای نمایش وجود ندارد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
