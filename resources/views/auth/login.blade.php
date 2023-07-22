@extends('layouts.auth.index')

@section('title', 'ورود')

@section('content')
<div class="d-flex flex-column flex-root">
	<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
		<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
			<a href="" class="mb-12">
				<img alt="Logo" src="{{ asset('admin/assets/media/logos/logo.png') }}" class="h-80px" />
			</a>
			<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
				<form method="POST" action="{{ route('login.config') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" >
					@csrf
					<div class="text-center mb-10">
						<h1 class="text-dark mb-3">به سامانه هم‌گروه خوش‌آمدید</h1>
						<div class="text-gray-400 fw-bold fs-4">
							<a href="" class="link-primary fw-bolder">ایجاد حساب کاربری</a>
						</div>
					</div>
					<div class="fv-row mb-10">
						<label class="form-label fs-6 fw-bolder text-dark">تلفن‌همراه</label>
						<input class="form-control form-control-lg form-control-solid input-just-number" type="text" name="phone" autocomplete="off" />
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-lg btn-primary btn-submit w-100 mb-5">
							<span class="indicator-label">ادامه</span>
							<span class="indicator-progress">لطفا چندلحظه صبر کنید ...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
							</span>
						</button>
						<div class="text-center text-muted text-uppercase fw-bolder mb-5">یا</div>
						<a href="{{ url('https://soha.emdad.ir') }}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
						<img alt="Logo" src="{{ asset('admin/assets/media/logos/emdad-logo.png') }}" class="h-40px me-3" />از طریق سامانه سها وارد شوید</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
