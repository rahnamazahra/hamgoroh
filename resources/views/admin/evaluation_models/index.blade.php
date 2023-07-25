@extends('layouts.admin.master')

@section('title', 'مدل‌های ارزیابی ')

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">مدل‌های ارزیابی</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">داشبورد</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">مدل‌های ارزیابی</li>
    </ul>
@endsection

@section('content')
    @can('evaluation-models-index')
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="card-title">
                <div class="position-relative my-1">
                </div>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="evaluation_models_list" class="table table-striped gy-7 gs-7">
                    <thead>
                    <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">عنوان</th>
                        {{--  <th class="text-center">اقدامات</th>  --}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($evaluation_models as $key => $evaluation_model)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $evaluation_model->title }}</td>
                            {{--  <td class="text-center">
                                <div class="btn btn-group-sm">
                                </div>
                            </td>  --}}
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="2">‌آیتمی برای نمایش وجود ندارد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
    @endcan
@endsection
