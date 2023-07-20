@extends('layouts.admin.master')
@section('title', 'داشبورد')
@section('content')
@can('admin-index')
    <div class="card">
        <div class="card-header">
        </div>
    </div>
@endcan
@endsection
