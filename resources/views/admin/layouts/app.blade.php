<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="ThemeSelect">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blank') | {{config('settings.company_name') ? config('settings.company_name') : "Clickgo"}}</title>
    <link rel="apple-touch-icon" href="{{config('settings.fav_icon') && Storage::disk('school')->exists(config('settings.fav_icon')) ? Storage::disk('school')->url(config('settings.fav_icon')) : asset("images/admin/favicon.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{config('settings.fav_icon') && Storage::disk('school')->exists(config('settings.fav_icon')) ? Storage::disk('school')->url(config('settings.fav_icon')) : asset("images/admin/favicon.png")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendors/vendors.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
    @stack('vendor-style')
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/themes/materialize.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/themes/style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/custom/custom.css")}}">
    @stack('style')
    <!-- END: Page Level CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('admin.layouts.topbar')
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    @include('admin.layouts.navigation')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            {{ $slot }}
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Notifications -->
    <div class="general-notification col-md-6">
        <div id="sucess-msg">
            @if (session('success'))
            <div id="sessionSuccess" class="hide">{{ session('success') }}</div>
            @endif
        </div>
        @if (session('error'))
        <div id="sessionError" class="hide">{{ session('error') }}</div>
        @endif
    </div>
    <!-- END: Notifications -->

    <!-- BEGIN: Footer-->
    @include('admin.layouts.footer')
    <!-- END: Footer-->

    <!-- BEGIN: Model-->
    <div id="model-area">
    </div>
    <!-- END: Model-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset("js/admin/themes/vendors.min.js")}}"></script>
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    @stack('vendor-script')
    <!-- END VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset("js/admin/themes/plugins.js")}}"></script>
    <script src="{{asset("js/admin/themes/search.js")}}"></script>
    <script src="{{asset("js/admin/custom/custom-script.js")}}"></script>
    <script src="{{asset("js/admin/themes/customizer.js")}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    @stack('script')
    <!-- END PAGE LEVEL JS-->
</body>

</html>