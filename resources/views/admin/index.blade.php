@extends('layouts.admin.master')
@section('title', 'داشبورد')
@section('content')
@include('admin.toast.errortoast')
@can('admin_index')
    <div class="card">
        <div class="card-header">
        </div>
    </div>
@endcan
@endsection
