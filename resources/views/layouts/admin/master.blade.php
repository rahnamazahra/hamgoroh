<!DOCTYPE html>
<html lang="fa">
<head>
	<title>@yield('title')|پنل‌مدیریت</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="fa" />
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	@include('layouts.admin.styles')
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" data-kt-app-layout="light-sidebar" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			@include('layouts.admin.sidebar')
			<!--end::Aside-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				@include('layouts.admin.header')
				<!--begin::breadcrumb-->
				<div class="toolbar" id="kt_toolbar">
					@include('layouts.admin.breadcrumb')
				</div>
				<!--end::breadcrumb-->
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-xxl">
							@yield('content')
						</div>
					</div>
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				@include('layouts.admin.footer')
				<!--end::Footer-->
			</div>
		</div>
	</div>
	<!--begin::Javascript-->
	@include('layouts.admin.scripts')
	<!--end::Javascript-->
</body>
</html>
