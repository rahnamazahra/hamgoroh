@extends('layouts.admin.master')
@section('title', 'دوره ها')
@section('content')
    @include('admin.toast.errortoast')

    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                <div class="position-relative my-1">
                    <div class="input-group input-group-solid">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                  d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z"
                                  fill="currentColor" />
                        </svg>
                    </span>
                        <input type="text" class="form-control" placeholder="جست و جو ..." wire:model="search_item" />
                    </div>
                </div>
            </div>
            <div class="card-toolbar">
                {{--            @can('fields-create')--}}
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#fieldCreateModal">دوره مسابقه جدید +</button>
                @include('admin.competitions.create')
                {{--            @endcan--}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="fields_list" class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">زمان شروع ثبت نام</th>
                        <th class="text-center">زمان پایان ثبت نام</th>
                        <th class="text-center">توضیحات ثبت نام</th>
                        <th class="text-center">قوانین</th>
                        <th class="text-center">شیوه نامه</th>
                        <th class="text-center">بنر</th>
                        <th class="text-center">اقدامات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($competitions as $key => $competitions)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $competitions->title }}</td>
                            <td class="text-center">{{ $competitions->registration_start_time }}</td>
                            <td class="text-center">{{ $competitions->registration_finish_time }}</td>
                            <td class="text-center">{{ $competitions->registration_description }}</td>
                            <td class="text-center">{{ $competitions->rules_description }}</td>
                            <td class="text-center">{{ $competitions->letter_method }}</td>
                            <td class="text-center">{{ $competitions->banner }}</td>
                            <td class="text-center">
                                <div class="btn btn-group-sm">
                                    {{-- @can('fields-update') --}}
                                    <button data-bs-toggle="modal" data-bs-target="#fieldUpdateModal" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"fill="currentColor"></path>
                                                </svg>
                                            </span>
                                    </button>
                                    {{-- @endcan
                                    @can('fields-delete') --}}
                                    {{-- <button data-bs-toggle="modal" data-bs-target="#fieldDeleteModal" wire:click="ConfirmDeleteUser({{ $user->id }})" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                <path opauser="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button> --}}
                                    {{-- @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="10">‌آیتمی برای نمایش وجود ندارد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

    @include('admin.competitions.update')
@endsection('content')