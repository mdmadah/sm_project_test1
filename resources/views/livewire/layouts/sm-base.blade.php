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
        input[data-switch-software] {
            display: none
        }

        input[data-switch-software]+label {
            width: 120px;
            height: 24px;
            background-color: #f1f3fa;
            background-image: none;
            border-radius: 2rem;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            position: relative;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out
        }

        input[data-switch-software]+label:before {
            color: #313a46;
            content: attr(data-off-label);
            display: block;
            font-family: inherit;
            font-weight: 600;
            font-size: .75rem;
            line-height: 24px;
            position: absolute;
            right: 15px;
            margin: 0 .21667rem;
            top: 0;
            text-align: center;
            min-width: 1.66667rem;
            overflow: hidden;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out
        }

        input[data-switch-software]+label:after {
            content: '';
            position: absolute;
            left: 4px;
            background-color: #adb5bd;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-radius: 2rem;
            height: 18px;
            width: 18px;
            top: 3px;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out
        }

        input[data-switch-software]:checked+label {
            background-color: #727cf5
        }

        input[data-switch-software]:checked+label:before {
            color: #fff;
            content: attr(data-on-label);
            right: auto;
            left: 4px
        }

        input[data-switch-software]:checked+label:after {
            left: 100px;
            background-color: #f1f3fa
        }

        input[data-switch-software=bool]+label {
            background-color: #fa5c7c
        }

        input:disabled+label {
            opacity: .5;
            cursor: default
        }

        input[data-switch-software=bool]+label:before,
        input[data-switch-software=bool]:checked+label:before {
            color: #fff !important
        }

        input[data-switch-software=bool]+label:after {
            background-color: #f1f3fa
        }
    </style>
    @livewireStyles

</head>



<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            @include('livewire.s-m-component.sm_menu.sm_left')
            @include('livewire.s-m-component.sm_menu.sm_top')
            @include('livewire.s-m-component.sm_menu.sm_right')

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

    @stack('scripts')
    @livewireScripts
</body>

</html>
