<!DOCTYPE html>
<html lang="fa" dir="rtl">
	<head>
		<title>سامانه هم‌گروه - @yield('title')</title>

		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:url" content="https://hamgoroh.ir/login" />
		<meta property="og:site_name" content="سامانه هم‌گروه - احرازهویت" />

        <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/fav.png') }}" />
        <!--begin::Fonts-->
		<link rel="stylesheet" href="{{ asset('admin/assets/plugins/global/fonts/yekan-perrsian-numeral/font.css') }}" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/global/plugins.bundle.rtl.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.bundle.rtl.css') }}" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body font-iy">
		<!--begin::Main-->
        <!--begin::Root-->
        @yield('content')
        <!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		@include('layouts.admin.scripts')
        @include('layouts.admin.alert')
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		@yield('scripts')
		<script>
			// Toggle Submit Button To Loading
			var button = document.querySelector(".btn-submit");

			button.addEventListener("click", function () {
				button.setAttribute("data-kt-indicator", "on");
				setTimeout(function () {
					button.removeAttribute("data-kt-indicator");
				}, 3000);
			});
		</script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
