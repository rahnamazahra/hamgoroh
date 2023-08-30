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
        <li class="breadcrumb-item text-dark">مراحل</li>
    </ul>
@endsection

@section('content')
    @can('news-index')
        @foreach($results as $result)
        <div class="card shadow-sm my-5">
            <div class="card-header">
                <div class="card-title">
                   {{ \App\Models\Competition::find($result['competition_id'])->title }}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="permissions_list" class="table table-striped gy-7 gs-7">
                        <thead>
{{--                            @foreach($result['challenges'] as $challenge)--}}
{{--                                <tr>--}}
{{--                                    @php--}}
{{--                                        $challenges = \App\Models\Challenge::find($challenge);--}}
{{--                                    @endphp--}}
{{--                                    <th class="fs-4"><a href="{{ route('admin.referee.create', ['challenge' => $challenges->id]) }}">{{ $challenges->challengeName() }}</a></th>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}

                        @foreach($result['steps'] as $step)
                            <tr>
                                @php
                                    $steps = \App\Models\Step::find($step);
                                @endphp
                                <th class="fs-4"><a href="{{ route('admin.referee.create', ['step' => $steps->id]) }}">{{ $steps->challenge->id . ' '. $steps->title }}</a></th>
                            </tr>
                        @endforeach
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @endforeach
    @endcan
@endsection
