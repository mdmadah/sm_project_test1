<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PManangement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

</head>

<body class="loading" data-layout-config='{"darkMode":false}'>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg py-lg-3 navbar-dark">
        <div class="container">

            <!-- logo -->
            <a href="#" class="navbar-brand me-lg-5">
                <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" class="logo-dark" height="25">
            </a>

            <!-- menus -->
            <ul class="list-unstyled topbar-menu float-end mb-0 align-items-center">
                <li>
                    <a href="{{ url('/login') }}" target="_blank"
                        class="nav-link dropdown-toggle arrow-none me-0 btn-sm btn-light btn-rounded">
                        <i class='uil uil-entry'></i>&nbsp&nbspLog in
                    </a>
                </li>
            </ul>

            <!-- menus อันเก่า-->
            {{-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="navbar-nav ms-auto align-items-center">
                    <!-- right menu -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-it me-0">
                            <a href="{{ route('LoginPage') }}" target="_blank"
                                class="btn btn-sm btn-light btn-rounded d-none d-lg-inline-flex">
                                <i class='uil uil-entry'></i>&nbsp&nbspLog in
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}

        </div>
    </nav>
    <!-- NAVBAR END -->


    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <div>
                            <span class="badge bg-danger rounded-pill">New</span>
                            <span class="text-white-50 ms-1">Welcome to PManangement</span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Manage your projects successfully with the PManangement.
                        </h2>

                        <p class="mb-4 font-16 text-white-50">Bring your team’s work together in one shared space.
                            Choose the project view that suits your style, and collaborate no matter where you are.
                        </p>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="assets/images/startup.svg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>
