<!-- LOGO -->
<a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
    <span class="logo-lg">
        <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" height="25">
    </span>
    <span class="logo-sm">
        <img src="{{ URL::asset('assets/images/logo_sm.png') }}" alt="" height="25">
    </span>
</a>
<div class="h-100" id="leftside-menu-container" data-simplebar="">
    <!--- Sidemenu -->
    <ul class="side-nav">

        <li class="side-nav-title side-nav-item">
            <i class="mdi mdi-database-outline"></i>
            การจัดการข้อมูลพื้นฐาน
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.nametitle') }}" class="side-nav-link">
                <span> ข้อมูลคำนำหน้าชื่อ </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.Address') }}" class="side-nav-link">
                <span> ข้อมูลตำบล อำเภอ จังหวัด </span>
            </a>
        </li>
        {{-- Activity Type --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.Position') }}" class="side-nav-link">
                <span> ข้อมูลตำแหน่งงาน </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.UStype') }}" class="side-nav-link">
                <span> ข้อมูลประเภทของกิจกรรม </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.Priority') }}" class="side-nav-link">
                <span> ข้อมูล Priority </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.Pert') }}" class="side-nav-link">
                <span> ข้อมูล PERT </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.Company') }}" class="side-nav-link">
                <span> ข้อมูลองค์กร </span>
            </a>
        </li>
        <li class="side-nav-title side-nav-item">
            <i class="mdi mdi-account-details"></i>
            การจัดการข้อมูลผู้ใช้งาน
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.Owner') }}" class="side-nav-link">
                <span> ข้อมูลเจ้าของโครงการ </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('admin.User') }}" class="side-nav-link">
                <span> ข้อมูลผู้ใช้งานภายในองค์กร </span>
            </a>
        </li>

    </ul>
    <!-- End Sidebar -->
    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
