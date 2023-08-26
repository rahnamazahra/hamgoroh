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
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title">
                    <div class="position-relative my-1">
                        <form method="GET" action="{{ route('admin.notices.index') }}">
                            <div class="input-group input-group-sm input-group-solid">
                                <button type="submit" class="input-group-text btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z"
                                            fill="currentColor"/>
                                        <path opacity="0.3"
                                              d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z"
                                              fill="currentColor"/>
                                    </svg>
                                </button>
                                <input type="text" class="form-control form-control-solid" placeholder="جست و جو ..."
                                       name="search_item"/>
                            </div>
                        </form>
                    </div>
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
                            <th class="text-center">نمرات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($results as $key => $result)
                            <tr>
                                @if($step->level == 'provincial')
                                    @php
                                        $examiner = \App\Models\Examiner::find($result['examiner_id']);
                                    @endphp
                                    @if($examiner->participant->user->province->title == $referee->province->title)
                                        <td class="text-center">{{ $key }}</td>
                                        @if($result['scores'] != null)
                                            <td class="text-center">{{ $examiner->participant->user->fullName() }}</td>
                                        @else
                                            <td class="text-center"><a href="{{ route('admin.referee.create', ['step' => $step->id, 'examiner' => $examiner->id]) }}">{{ $examiner->participant->user->fullName() }}</a></td>
                                        @endif
                                        <td class="text-center">{{ $examiner->participant->user->national_code }}</td>
                                        <td class="text-center">
                                            @if($result['scores'] != null)
                                                @foreach($result['scores'] as $score)
                                                    <div>
                                                        <span>{{ \App\Models\Criteria::find($score['criteria_id'])->title }} : </span>
                                                        {{ $score['score'] }}
                                                    </div>
                                                @endforeach
                                            @else
                                                <div> نمره ندارد</div>
                                    @endif
                                @endif


                                @else
                                <td class="text-center">{{ $key }}</td>
                                @php
                                $examiner = \App\Models\Examiner::find($result['examiner_id']);
                                @endphp
                                @if($result['scores'] != null)
                                <td class="text-center">{{ $examiner->participant->user->fullName() }}</td>
                                @else
                                    <td class="text-center"><a href="{{ route('admin.referee.create', ['step' => $step->id, 'examiner' => $examiner->id]) }}">{{ $examiner->participant->user->fullName() }}</a></td>
                                @endif
                                <td class="text-center">{{ $examiner->participant->user->national_code }}</td>
                                <td class="text-center">
                                    @if($result['scores'] != null)
                                    @foreach($result['scores'] as $score)
                                        <div>
                                            <span>{{ \App\Models\Criteria::find($score['criteria_id'])->title }} : </span>
                                            {{ $score['score'] }}
                                        </div>
                                    @endforeach
                                    @else
                                        <div> نمره ندارد</div>
                                    @endif
                                </td>
                                @endif
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
            <div class="card-footer">
{{--                {{ $notices->links('pagination::bootstrap-5') }}--}}
            </div>
        </div>
@endsection
