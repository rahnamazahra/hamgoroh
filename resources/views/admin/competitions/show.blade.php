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
        <li class="breadcrumb-item text-dark">مدیریت دوره</li>
    </ul>
@endsection

@section('content')
        <div class="card shadow-sm col-xl-12">
            <div class="card-header">
                <div class="card-title">
                   <h1> مسابقه {{ $competition->title }} </h1>
                    <span class="h-20px ms-3 mx-2 me-1"></span>
                    @if($competition->is_active)
                        <span class="badge badge-light-success">فعال</span>
                    @else
                        <span class="badge badge-light-danger">غیرفعال</span>
                    @endif
                </div>
                <div class="card-toolbar">
                    <div>
                        <span class="text-muted"> {{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_start_time))->format('Y/m/d H:i:s') }} </span>
                    </div>
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <div class="">
                        <span class="text-muted"> {{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($competition->registration_finish_time))->format('Y/m/d H:i:s') }} </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-9">
                    <div class="col-md-4 fv-row">
                        @php
                            $banner = $competition->files->where('related_field', 'banner')->pluck('path')->first();
                        @endphp
                        <div class="cole-md-12">
                            @if($banner)
                                <image class="img-fluid rounded" src="{{ asset('/upload/'. $banner) }}" alt="banner">
                            @else
                                <image class="img-fluid rounded" src="{{ asset('admin/assets/media/icons/duotune/general/gen006.svg') }}" alt="banner">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 fv-row">
                        <div class="col-md-12 my-3">
                            <span class="text-gray-400 fw-bolder">
                                قوانین مسابقه:
                                <p class="text-gray-800 fw-bolder rtl-justify"> {!! $competition->rules_description ?? 'ندارد' !!} </p>
                            </span>
                        </div>
                        <div class="col-md-12 my-3">
                            <span class="text-gray-400 fw-bolder">
                                توضیحات مسابقه:
                                 <p class="text-gray-800 fw-bolder rtl-justify"> {!! $competition->registration_description ?? 'ندارد' !!} </p>
                            </span>
                        </div>

                        <div class="col-md-12 my-3">
                            <span class="text-gray-400 fw-bolder">
                                ایجاد کننده دوره:
                                <span class="text-gray-800 fw-bolder"> {{ $competition->user ? $competition->user->first_name . ' ' . $competition->user->last_name : ' مشخص نشده' }} </span>
                            </span>
                        </div>
                        <div class="col-md-12 my-5">
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                    @php
                                        $letter_method = \App\Models\File::where('fileable_id', $competition->id)->where('related_field', 'letter_method')->pluck('path')->first();
                                    @endphp
                                    @if($letter_method)

                                    <a href="{{ url('upload/'.$letter_method) }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary btn-hover-rise">
                                        <i class="bi bi-download"></i>
                                        دانلود شیوه نامه
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @forelse($challenges as $challenge)
            <div class="card shadow-sm col-xl-12 my-10">
                <div class="card-header">
                    <div class="card-title"> رشته {{ $challenge->field->title }} </div>
                </div>
                <div class="card-body">
                    <div class="row g-9">
                        <div class="table-responsive">
                            <table id="steps_challenge_list" class="table table-striped gy-7 gs-7">
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <button type="button" onclick="toggle_inventories({{ $challenge->id }})" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px">
                                                <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <span class="svg-icon svg-icon-3 m-0 toggle-on">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <div class="position-relative ps-6 pe-3 py-2">
                                                <span class="mb-1 text-dark"> {{ $challenge->age->title }} - </span>

                                                @if($challenge->gender == 0)
                                                    <span class="mb-1 text-dark"> خواهران  - </span>
                                                @elseif($challenge->gender == 1)
                                                    <span class="mb-1 text-dark"> برادران - </span>
                                                @else
                                                    <span class="mb-1 text-dark"></span>
                                                @endif

                                                @if($challenge->nationality == 0)
                                                    <span class="mb-1 text-dark"> ایرانی </span>
                                                @elseif($challenge->nationality == 1)
                                                    <span class="mb-1 text-dark"> خارجی </span>
                                                @else
                                                    <span class="mb-1 text-dark"></span>
                                                @endif
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end">
                                            <div class="btn btn-group-sm">
                                                <a href="{{ route('admin.challenges.info.create', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="اطلاعات تکمیلی"> اطلاعات تکمیلی </a>
                                                <a href="" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی"> زمان‌بندی </a>
                                                <a href="{{ route('admin.techniques.index', ['challenge' => $challenge->id]) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="تکنیک">تکنیک</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach($challenge->steps as $key => $step)
                                        <tr class="x{{ $step->challenge_id }} m-4" style="display: none;">
                                            <td class="p-4 text-center"> {{ $key + 1 }} </td>
                                            <td class="p-4 text-center">
                                                <div class="text-gray-800 fs-7 me-3"> {{ $step->title }} </div>
                                            </td>
                                            <td class="p-4 text-center">
                                                <div class="text-muted fs-7 me-3 text-center fw-bolder"> نوع آزمون مسابقات</div>
                                                @switch($step->type)
                                                    @case('video_upload')
                                                        <div class="text-gray-800 fs-7 text-center">آپلود ویدئو</div>
                                                    @break
                                                    @case('image_upload')
                                                        <div class="text-gray-800 fs-7 text-center">آپلود عکس </div>
                                                    @break
                                                    @case('voice_upload')
                                                        <div class="text-gray-800 fs-7 text-center">آپلود صوت</div>
                                                    @break
                                                     @case('document_upload')
                                                        <div class="text-gray-800 fs-7 text-center">آپلود سند</div>
                                                    @break
                                                    @case('text')
                                                        <div class="text-gray-800 fs-7 text-center">متن</div>
                                                    @break
                                                    @case('call')
                                                        <div class="text-gray-800 fs-7 text-center">تماس تلفنی</div>
                                                    @break
                                                    @case('test')
                                                        <div class="text-gray-800 fs-7 text-center">آزمون آنلاین چهارگزینه ای</div>
                                                    @break
                                                    @case('video_online')
                                                        <div class="text-gray-800 fs-7 text-center">آزمون آنلاین تصویری</div>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="p-4 text-center">
                                                <div class="text-muted fs-7 me-3 text-center fw-bolder">سطح برگذاری مسابقات </div>
                                                @if($step->level == 'provincial')
                                                    <div class="text-gray-800 fs-7 text-center">استانی</div>
                                                @else
                                                    <div class="text-gray-800 fs-7 text-center">کشوری</div>
                                                @endif
                                            </td>
                                            <td class="p-4 text-center">
                                                <div class="text-muted fs-7 me-3 text-center fw-bolder">ضریب</div>
                                                <div class="text-gray-800 fs-7 text-center"> {{ $step->weight }} </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="btn btn-group-sm">
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی"> زمان‌بندی</button>
                                                    <button type="button" class="btn btn-sm btn-success" onclick="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="داوری"> داوری</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
@endsection

@section('custom-scripts')
<script>
    function toggle_inventories(challenge_id)
    {
        $('.x'+challenge_id).toggle();
    }
</script>
@endsection
