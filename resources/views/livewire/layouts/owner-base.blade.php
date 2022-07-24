<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <!-- third party css -->
    <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ URL::asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

    {{-- Bootstrap Styles --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"> --}}
    <style>
        .cards{
            padding-bottom: .5rem;
            padding-left: .5rem;
            padding-right: .5rem;
            padding-top: .5rem;
            /* padding: .5rem; */
            /* padding-top: 1.5rem; */
     /* display: inline-block; */
     border-radius: 5px; 
     /* margin: 2%; */
    }

        .us_color{
            /* -webkit-box-flex:1; */
            /* -ms-flex:1 1 auto;
            flex:1 1 auto; */
            padding: 0rem;
        }
    </style>

    @livewireStyles

</head>



<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            @include('livewire.owner-component.owner_menu.owner_left')
            @include('livewire.owner-component.owner_menu.owner_top')
            @include('livewire.owner-component.owner_menu.owner_right')


            {{ $slot }}
        </div>
    </div>



    <!-- bundle -->
    <script src="{{ URL::asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ URL::asset('assets/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ URL::asset('assets/js/pages/demo.dashboard.js') }}"></script>
    <!-- end demo js-->

    {{-- Bootstrap Scripts --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script> --}}

    @stack('scripts')
    @livewireScripts
</body>

</html>
