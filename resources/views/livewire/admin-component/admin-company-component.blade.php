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
                {{-- start add --}}
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                                    <li class="breadcrumb-item active">ข้อมูลองค์กร</li>
                                </ol>
                            </div>
                            <h4 class="page-title">ข้อมูลองค์กร
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#add-new-task-modal" class="btn btn-success btn-sm ms-3">Add New</a></h4> --}}
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Billing Content-->
                <div class="tab-pane show active" id="billing-information">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('addCompany') }}" name="editCompany-form">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="billing-first-name"
                                                class="form-label">ชื่อองค์กรภาษาอังกฤษ</label>
                                            <input name="name_en" id="form-name_en" class="form-control" readonly
                                                type="text" value="{{ $compa->name_en }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="billing-first-name" class="form-label">ชื่อองค์กรภาษาไทย</label>
                                            <input name="name_th" id="form-name_th" class="form-control" readonly
                                                type="text" value="{{ $compa->name_th }}">
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-email-address" class="form-label">เบอร์โทรองค์กร</label>
                                            <input name="phone" id="form-phone" class="form-control" readonly
                                                type="text" value="{{ $compa->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-phone" class="form-label">อีเมลองค์กร</label>
                                            <input name="email" id="form-email" class="form-control" readonly
                                                type="email" value="{{ $compa->email }}">
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-town-city" class="form-label">บ้านเลขที่</label>
                                            <input name="no" id="form-no" class="form-control" readonly
                                                type="text" value="{{ $compa->no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-state" class="form-label">หมู่ที่</label>
                                            <input name="mu" id="form-mu" class="form-control" readonly
                                                type="text" value="{{ $compa->mu }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-zip-postal" class="form-label">ถนน</label>
                                            <input name="street" id="form-street" class="form-control" readonly
                                                type="text" value="{{ $compa->street }}">
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">จังหวัด</label>
                                            <select class="form-select form-control-light" disabled
                                                id="input_province" name="province">

                                                @if (!is_null($compa->province))
                                                    <option value="{{ $compa->province }}">{{ $compa->province }}
                                                    </option>
                                                @else
                                                    <option value="" selected>เลือกจังหวัด</option>
                                                @endif
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->province }}">{{ $item->province }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- <input name="provice" id="form-provice" class="form-control" disabled type="text" value="{{$compa->province}}"> --}}
                                        </div>
                                    </div>
                                    {{-- @if (!is_null($selectedProvince)) --}}
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="billing-address" class="form-label">อำเภอ</label>
                                            <select class="form-select form-control-light" id="input_amphoe" disabled
                                                name="amphure">
                                                @if (!is_null($compa->amphure))
                                                    <option value="{{ $compa->amphure }}">{{ $compa->amphure }}
                                                    </option>
                                                @else
                                                    <option value="" selected>เลือกอำเภอ</option>
                                                @endif

                                                {{-- @foreach ($amphoes as $item)
                                                        <option value="{{ $item->amphoe_code }}">{{ $item->amphoe }}</option>
                                                        @endforeach --}}
                                            </select>
                                            {{-- <input name="amphure" id="form-amphure"  class="form-control" disabled type="text" value="{{$compa->amphure}}"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="tambon_amphoe">
                                        <div class="mb-3">
                                            <label for="billing-address" class="form-label">ตำบล</label>
                                            <select class="form-select form-control-light" id="input_tambon" disabled
                                                name="district">

                                                @if (!is_null($compa->district))
                                                    <option value="{{ $compa->district }}">{{ $compa->district }}
                                                    </option>
                                                @else
                                                    <option value="" selected>เลือกตำบล</option>
                                                @endif
                                                {{-- @foreach ($tambons as $item)
                                                        <option value="{{ $item->tambon_code }}">{{ $item->tambon }}</option>
                                                        @endforeach --}}
                                            </select>
                                            {{-- <input name="district" id="form-district" class="form-control" readonly type="text" value="{{$compa->district}}" > --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="postcode_amphoe">
                                        <div class="mb-3">
                                            <label for="billing-address" class="form-label">รหัสไปรษณีย์</label>
                                            <input name="postcode" id="input_zipcode" class="form-control" readonly
                                                type="text" value="{{ $compa->postcode }}">
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="text-end">
                                    <button type="button" id="edit-btn" onclick="Edit()" class="btn btn-primary"
                                        style="visibility:visible" value="แก้ไข">แก้ไข</button>
                                    <button type="submit" id="save-btn" onclick="Edit()" class="btn btn-primary"
                                        style="visibility:hidden">บันทึก</button>
                                    {{-- <button type="button" onclick="EditData() " class="btn btn-primary ">บันทึก</button> --}}
                                    {{-- <input type="button" id="avgbtn" value="2015 Season Avg" class="offgo" onclick="toggleStateavg()" />
                                        <input type="button" id="tradebtn" value="2015 Trade Deadline" class="ongo" onclick="toggleStateavg()"/> --}}
                                </div>
                            </form>
                        </div>

                    </div> <!-- end row-->
                </div>
                <!-- End Billing Information Content-->
            </div>
            <!-- end Content-->
        </div>
        <!-- END wrapper -->

        <!-- enable/disable form -->
        <script>
            function Edit() {

                let edit = document.getElementById("edit-btn");
                let save = document.getElementById("save-btn");

                var inputs = document.forms["editCompany-form"].getElementsByTagName("input");
                var selects = document.forms["editCompany-form"].getElementsByTagName("select");



                if (edit.innerText == "แก้ไข") {
                    edit.innerText = "ยกเลิก";
                    edit.style.backgroundColor = "#F1F4F8";
                    edit.style.color = "#313A46";
                    save.style.visibility = "visible";

                    for (i = 0; i < inputs.length - 1; i++) {
                        inputs[i].readOnly = false;
                    }

                    // for (i=0; i<selects.length; i++){
                    selects[0].disabled = false;

                    // }

                } else if (edit.innerText == "ยกเลิก") {
                    location.reload();

                }

            }
        </script>

        {{-- adress form --}}
        <script>
            function showAmphoes() {
                let input_province = document.querySelector("#input_province");
                let url = "{{ url('/api/getAmphoes') }}?province=" + input_province.value;
                console.log(url);
                fetch(url)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result);
                        //UPDATE SELECT OPTION
                        let input_amphoe = document.querySelector("#input_amphoe");
                        document.querySelectorAll('#input_amphoe option').forEach(option => option.remove())
                        for (let item of result) {
                            let option = document.createElement("option");
                            option.text = item.amphoe;
                            option.value = item.amphoe;
                            input_amphoe.appendChild(option);
                            input_amphoe.disabled = false;

                        }
                        //QUERY AMPHOES
                        // showTambons();
                    });
            }

            function showTambons() {
                // let input_province = document.querySelector("#input_province");
                let input_amphoe = document.querySelector("#input_amphoe");
                let url = "{{ url('/api/getDistricts') }}?province=" + input_province.value + "&amphoe=" + input_amphoe
                .value;
                console.log(url);
                // if(input_province.value == "") return;        
                // if(input_amphoe.value == "") return;
                fetch(url)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result);
                        //UPDATE SELECT OPTION
                        let input_tambon = document.querySelector("#input_tambon");
                        document.querySelectorAll('#input_tambon option').forEach(option => option.remove())
                        for (let item of result) {
                            let option = document.createElement("option");
                            option.text = item.tambon;
                            option.value = item.tambon;
                            input_tambon.appendChild(option);
                            input_tambon.disabled = false;
                        }
                        //QUERY AMPHOES
                        // showZipcode();
                    });
            }

            function showZipcode() {
                let input_province = document.querySelector("#input_province");
                let input_amphoe = document.querySelector("#input_amphoe");
                let input_tambon = document.querySelector("#input_tambon");
                let url = "{{ url('/api/getZipcodes') }}?province=" + input_province.value + "&amphoe=" + input_amphoe
                    .value + "&tambon=" + input_tambon.value;
                console.log(url);
                // if(input_province.value == "") return;        
                // if(input_amphoe.value == "") return;     
                // if(input_tambon.value == "") return;
                fetch(url)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result);
                        //UPDATE SELECT OPTION
                        for (let item of result) {
                            document.querySelector("#input_zipcode").value = item.zipcode;
                            break;
                        }
                    });
            }
            //EVENTS
            document.querySelector('#input_province').addEventListener('change', (event) => {
                showAmphoes();
                document.querySelector("#input_zipcode").value = '';
            });
            document.querySelector('#input_amphoe').addEventListener('change', (event) => {
                showTambons();
                document.querySelector("#input_zipcode").value = '';
            });
            document.querySelector('#input_tambon').addEventListener('change', (event) => {
                showZipcode();
            });
        </script>



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
