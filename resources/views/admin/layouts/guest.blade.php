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
    <title>@yield('title', 'Blank Page') | Grand Marche</title>
    <link rel="apple-touch-icon" href="{{asset("images/admin/favicon.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("images/admin/favicon.png")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("vendors/vendors.min.css")}}">
    @stack('vendor-style')
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/themes/materialize.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/themes/style.css")}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("css/admin/custom/custom.css")}}">
    <!-- END: Custom CSS-->
    @stack('style')
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                {{ $slot }}
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset("js/admin/themes/vendors.min.js")}}"></script>
    @stack('vendor-script')
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset("js/admin/themes/plugins.js")}}"></script>
    <script src="{{asset("js/admin/themes/search.js")}}"></script>
    <script src="{{asset("js/admin/custom/custom-script.js")}}"></script>
    <!-- END THEME  JS-->
    @stack('script')
</body>

</html>