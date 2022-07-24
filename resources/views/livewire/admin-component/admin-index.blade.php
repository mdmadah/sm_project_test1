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

</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            @include('livewire.admin-component.admin_menu.admin_left')
            @include('livewire.admin-component.admin_menu.admin_top')
            @include('livewire.admin-component.admin_menu.admin_right')

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <form class="d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-light"
                                            id="dash-daterange">
                                        <span class="input-group-text bg-primary border-primary text-white">
                                            <i class="mdi mdi-calendar-range font-13"></i>
                                        </span>
                                    </div>
                                    <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                        <i class="mdi mdi-autorenew"></i>
                                    </a>
                                    <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                        <i class="mdi mdi-filter-variant"></i>
                                    </a>
                                </form>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Online Store Visitors</h3>
                                    <a href="javascript:void(0);">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">820</span>
                                        <span>Visitors Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> 12.5%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="visitors-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This Week
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last Week
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title">Total Sales</h4>

                                <div id="average-sales" class="apex-charts mb-4 mt-4"
                                    data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>


                                <div class="chart-widget-list">
                                    <p>
                                        <i class="mdi mdi-square text-primary"></i> Direct
                                        <span class="float-end">$300.56</span>
                                    </p>
                                    <p>
                                        <i class="mdi mdi-square text-danger"></i> Affilliate
                                        <span class="float-end">$135.18</span>
                                    </p>
                                    <p>
                                        <i class="mdi mdi-square text-success"></i> Sponsored
                                        <span class="float-end">$48.96</span>
                                    </p>
                                    <p class="mb-0">
                                        <i class="mdi mdi-square text-warning"></i> E-mail
                                        <span class="float-end">$154.02</span>
                                    </p>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->

            </div>
            <!-- end content -->

        </div>
    </div>
        <!-- END wrapper -->



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
</body>

</html>
