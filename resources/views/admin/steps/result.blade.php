@extends('layouts.admin.master')

@section('title', 'نتایج آزمون')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">نتایج آزمون {{ $step->challenge->challengeName() }} مرحله {{ $step->title }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.index') }}" class="text-muted text-hover-primary">لیست مسابقات</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.competitions.show', ['competition' => $competition->id]) }}" class="text-muted text-hover-primary">مدیریت مسابقه {{ $competition->title }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">نتایج آزمون {{ $step->challenge->challengeName() }} مرحله {{ $step->title }}</li>
    </ul>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                <div class="position-relative my-1">
                    {{-- <form method="GET" action="{{ route('admin.scores.index', ['step' => $step->id]) }}">
                        <div class="input-group input-group-sm input-group-solid">
                            <button type="submit" class="input-group-text btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor" />
                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor" />
                                </svg>
                            </button>
                            <input type="text" class="form-control form-control-solid" placeholder="جست و جو ..." name="search_item" />
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="scores_list" class="table table-striped gy-7 gs-7">
                    <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">نام کاربر</th>
                            <th class="text-center">کدملی کاربر</th>
                            <th class="text-center">استان</th>
                            @foreach ($criteria_referee as $cr)
                                <th class="text-center">{{ $cr['criteria_title'] }} - {{  $cr['referee_title'] }}</th>
                            @endforeach
                            @foreach ($step->evaluations as $evaluation)
                                @if ($evaluation->refereeing_type == 'average')
                                    <th class="text-center">میانگین {{ $evaluation->criteria->title }}</th>
                                @endif
                            @endforeach
                            <th class="text-center">نمره</th>
                            <th class="text-center">وضعیت قبولی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($criteria_referee_examiner as $key => $cre)
                            <tr>
                                @php
                                    $examiner = \App\Models\Examiner::find($cre['examiner_id']);
                                    $user = $examiner->getUser();
                                @endphp
                                <th class="text-center">{{ $key }}</th>
                                <th class="text-center">{{ $user->fullName() }}</th>
                                <th class="text-center">{{ $user->national_code }}</th>
                                <th class="text-center">{{ $user->province->title }}</th>
                                @foreach ($criteria_referee as $cr)
                                    <th class="text-center">{{ $cre['criteria_referee'][$cr['criteria_id'].$cr['referee_id']] }}</th>
                                @endforeach
                                <th class="text-center">
                                    @foreach ($step->evaluations as $evaluation)
                                        @if ($evaluation->refereeing_type == 'average')
                                            @php

                                            @endphp
                                        @endif
                                    @endforeach
                                    @php

                                    @endphp
                                </th>
                                <th class="text-center">{{ $cre['score'] }}</th>
                                <th class="text-center">
                                    @if ($examiner->is_passed == 0)
                                        <span class="badge badge-light-success">قبول</span>
                                    @else
                                        <span class="badge badge-light-danger">رد شده</span>
                                    @endif
                                </th>
                            </tr>
                        @empty
                            <span>آیتمی ثبت نشده است</span>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{-- {{ $permissions->withQueryString()->links('pagination::bootstrap-5') }} --}}
        </div>
    </div>
@endsection
