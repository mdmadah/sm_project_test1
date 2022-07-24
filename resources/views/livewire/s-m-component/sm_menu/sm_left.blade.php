<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">
        <!-- LOGO -->
        <a href="{{ route('sm.dashboard') }}" class="logo text-center logo-light">
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

                {{-- การจัดการข้อมูลพื้นฐาน --}}
                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-database-outline"></i>
                    การจัดการข้อมูลพื้นฐาน
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('sm.nametitle') }}" class="side-nav-link">
                        <span> ข้อมูลคำนำหน้าชื่อ </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Address') }}" class="side-nav-link">
                    <span> ข้อมูลตำบล อำเภอ จังหวัด </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Position') }}" class="side-nav-link">
                        <span> ข้อมูลตำแหน่งงาน </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.UStype') }}" class="side-nav-link">
                    <span> ข้อมูลประเภทของกิจกรรม </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Priority') }}" class="side-nav-link">
                    <span> ข้อมูล Priority </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Pert') }}" class="side-nav-link">
                        <span> ข้อมูล PERT </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Company') }}" class="side-nav-link">
                    <span> ข้อมูลองค์กร </span>
                    </a>
                </li>
                {{-- END การจัดการข้อมูลพื้นฐาน --}}

                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-account-details"></i>
                    การจัดการข้อมูลผู้ใช้งาน
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('sm.Owner') }}" class="side-nav-link">
                    <span> ข้อมูลเจ้าของโครงการ </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('sm.User') }}" class="side-nav-link">
                    <span> ข้อมูลผู้ใช้งานภายในองค์กร </span>
                    </a>
                </li>

                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-briefcase-variant-outline"></i>
                    การจัดการข้อมูลโครงการ
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('sm.Software') }}" class="side-nav-link">
                    <span> ข้อมูลโครงการ </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.US') }}" class="side-nav-link">
                    <span> ข้อมูล User Story </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.Act') }}" class="side-nav-link">
                    <span> ข้อมูลงานใน User Story </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.ActOrder') }}" class="side-nav-link">
                    <span> ลำดับงาน </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('sm.CPM') }}" class="side-nav-link">
                    <span> การวิเคราะห์ด้วย CPM </span>
                    </a>
                </li>

                <li class="side-nav-title side-nav-item">
                    <i class="mdi mdi-chart-box-outline"></i>
                    รายงาน
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('sm.FinalReport') }}" class="side-nav-link">
                        <span> สรุปโครงการ </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    {{-- <a href="{{ route('sm/report/team_performance') }}" class="side-nav-link"> --}}
                        <span> การทำงานของทีม </span>
                    {{-- </a> --}}
                </li>

                <li class="side-nav-item">
                    {{-- <a href="{{ route('sm/report/software_progress') }}" class="side-nav-link"> --}}
                        <span> ความก้าวหน้า </span>
                    {{-- </a> --}}
                </li>

            </ul>
            <!-- End Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
</div>
</div>
