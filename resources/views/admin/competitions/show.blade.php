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


                                    <button class="btn btn-sm btn-primary show menu-dropdown"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true"> ویرایش
                                    </button>

                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true" style="z-index: 105; position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-42px, 0px);" data-popper-placement="top-end" data-popper-reference-hidden="" data-popper-escaped="">
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.competitions.main_edit', ['competition' => $competition->id]) }}" class="menu-link px-3">اطلاعات مسابقه</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.groups.index', ['competition' => $competition->id]) }}" class="menu-link px-3">سبد و رشته</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>



                                    <a href="{{ route('admin.competitions.result', ['competition' => $competition->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="نتایج">نتایج آزمون</a>
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
                    <div class="card-toolbar">
                        <a href="{{ route('admin.challenges.selfCreate', ['competition' => $competition->id, 'field' => $challenge->field->id]) }}" class="btn btn-sm btn-active-primary btn-outline btn-outline-primary btn-text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom">زیررشته جدید</a>
                    </div>
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
                                                <a href="{{ route('admin.steps.selfCreate', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-sm btn-active-primary btn-outline btn-outline-primary btn-text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom">مرحله جدید</a>
                                                <a href="{{ route('admin.challenges.selfEdit', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-active-success btn-outline btn-outline-success btn-text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">ویرایش</a>
                                                <button name="btn_delete_item" class="btn btn-active-danger btn-outline btn-outline-danger btn-text-danger" data-id="{{ $challenge->id }}" data-url="{{ route('admin.challenges.delete', ['challenge' => $challenge->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">حذف</button>
                                            @if($challenge->description != null)
                                                <a href="{{ route('admin.challenges.info.create', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-icon-success btn-active-icon-success btn-active-secondary  btn-text-gray-700" data-bs-toggle="tooltip" data-bs-placement="bottom" title="اطلاعات تکمیلی"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
                                                    </svg></span>اطلاعات تکمیلی</a>
                                                @else
                                                    <a href="{{ route('admin.challenges.info.create', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-active-dark btn-outline btn-outline-dark btn-text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="اطلاعات تکمیلی">اطلاعات تکمیلی</a>
                                                @endif
                                                @if($challenge->result_start_time != null)
                                                <a href="{{ route('admin.challenges.schedule.create', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-icon-success btn-active-icon-success btn-active-secondary  btn-text-gray-700" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
                                                    </svg></span>زمان‌بندی</a>
                                                    @else
                                                        <a href="{{ route('admin.challenges.schedule.create', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-active-info btn-outline btn-outline-info btn-text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی">زمان‌بندی</a>
                                                    @endif
                                                    @if($challenge->techniques()->exists())
                                                <a href="{{ route('admin.techniques.index', ['challenge' => $challenge->id]) }}" class="btn btn-icon-success btn-active-icon-success btn-active-secondary  btn-text-gray-700" data-bs-toggle="tooltip" data-bs-placement="bottom" title="تکنیک"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
                                                    </svg></span>تکنیک</a>
                                                    @else
                                                        <a href="{{ route('admin.techniques.index', ['challenge' => $challenge->id]) }}" class="btn btn-active-warning btn-outline btn-outline-warning btn-text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="تکنیک">تکنیک</a>
                                                    @endif
                                                <a href="{{ route('admin.challenges.result', ['competition' => $competition->id, 'challenge' => $challenge->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="نتایج">نتایج آزمون</a>
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
                                                        <div class="ftext-gray-800 fs-7 text-center">آپلود ویدئو</div>
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
                                                    <a href="{{ route('admin.steps.selfEdit', ['competition' => $competition->id, 'step' => $step->id]) }}" class="btn btn-active-success btn-outline btn-outline-success btn-text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش">ویرایش</a>
                                                    <button name="btn_delete_item" class="btn btn-active-danger btn-outline btn-outline-danger btn-text-danger" data-id="{{ $step->id }}" data-url="{{ route('admin.steps.delete', ['step' => $step->id]) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">حذف</button>
                                                    @if($step->schedules()->exists())
                                                    <a href="{{ route('admin.schedules.index', ['step' => $step->id])}}" class="btn btn-icon-success btn-active-icon-success btn-active-secondary  btn-text-gray-700" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
                                                    </svg></span> زمان‌بندی</a>
                                                    @else
                                                        <a href="{{ route('admin.schedules.index', ['step' => $step->id])}}" class="mx-3 btn btn-active-info btn-outline btn-outline-info btn-text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="زمان‌بندی"> زمان‌بندی</a>
                                                    @endif
                                                    @if($step->evaluations()->exists())
                                                        <a href="{{ route('admin.evaluations.index', ['step' => $step->id])}}" class="btn btn-sm btn-icon-success btn-active-icon-success btn-active-secondary  btn-text-gray-700" data-bs-toggle="tooltip" data-bs-placement="bottom" title="داوری"><span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/>
                                                    </svg></span> داوری</a>
                                                    @else
                                                    <a href="{{ route('admin.evaluations.index', ['step' => $step->id])}}" class="mx-3 btn btn-active-warning btn-outline btn-outline-warning btn-text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="داوری"> داوری</a>
                                                    @endif
                                                    <a href="{{ route('admin.steps.result', ['step' => $step->id])}}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="نتایج"> نتایج آزمون</a>
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
