<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">
        <!-- LOGO -->
        <a href="{{ route('ts.dashboard') }}" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" height="25">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo_sm.png') }}" alt="" height="16">
            </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">
            <!--- Sidemenu -->
            <ul class="side-nav">

                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-clipboard-list-outline"></i>
                    การจัดการงาน
                </li>

                <li class="side-nav-item">
                    <a href="{{ url('ts/task') }}" class="side-nav-link">
                        <span> รายการงานที่ต้องทำ </span>
                    </a>
                </li>

                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-chart-box-outline"></i>
                    รายงาน
                </li>

                <li class="side-nav-item">
                    <a href="{{ url('ts/software_progress') }}" class="side-nav-link">
                        <span> ความก้าวหน้า </span>
                    </a>
                </li>

                <!-- End Sidebar -->
                <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
</div>
</div>
