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

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            @include('livewire.s-m-component.sm_menu.sm_left')
            @include('livewire.s-m-component.sm_menu.sm_top')
            @include('livewire.s-m-component.sm_menu.sm_right')

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลโครงการ</a></li>
                                    <li class="breadcrumb-item active">ข้อมูลลำดับงานในแต่ละ User Story</li>
                                </ol>
                            </div>
                            <h4 class="page-title">จัดการลำดับงานในแต่ละ User Story
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#add-new-task-modal" class="btn btn-success btn-sm ms-3">Add New</a></h4> --}}
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                {{-- start Row --}}
                <form class="p-2" method="POST" action="{{ route('sm.storeorder') }}">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ชื่อโครงการ</label>
                                <select class="form-select form-control-light" name="sw_id" id="input_sw">
                                    <option>เลือกโครงการ</option>
                                    @foreach ($softwares as $sw)
                                    <option value="{{$sw->id}}">{{$sw->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">เจ้าของโครงการ</label>
                            <input readonly type="text" class="form-control form-control-light" id="input_owner">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">User Story Type</label>
                                <select class="form-select form-control-light" id="input_ust">
                                    <option>เลือกประเภทกิจกรรม</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">User Story</label>
                            <select class="form-select form-control-light" name="us_id" id="input_us">
                                <option>เลือก User Story</option>
                            </select>
                        </div>
                    </div>

                    <center>
                        <div class="row text-center">
                            <div class="col-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="responsive-preview">
                                                <div class="table-responsive">

                                                    <table class="table mb-0 text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>รหัส</th>
                                                                <th style="width:25%">ชื่องาน</th>
                                                                <th style="width:30%">ลำดับงานก่อนหน้า</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="item_table">

                                                        </tbody>
                                                    </table>

                                                </div> <!-- end table-responsive-->
                                            </div> <!-- end preview-->

                                            <div class="text-center p-3" style="display:none" id="submitzone">
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </div>

                </form>
                <div class="tab-pane" id="responsive-code">
                    <pre class="mb-0">
                                                    <span class="html escape">
                                                        &lt;table class=&quot;table mb-0&quot;&gt;
                                                            &lt;thead&gt;
                                                                &lt;tr&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;#&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                    &lt;th scope=&quot;col&quot;&gt;Heading&lt;/th&gt;
                                                                &lt;/tr&gt;
                                                            &lt;/thead&gt;
                                                            &lt;tbody&gt;
                                                                &lt;tr&gt;
                                                                    &lt;th scope=&quot;row&quot;&gt;1&lt;/th&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                    &lt;td&gt;Cell&lt;/td&gt;
                                                                &lt;/tr&gt;
                                                            &lt;/tbody&gt;
                                                        &lt;/table&gt;
                                                    </span>
                                                </pre> <!-- end highlight-->
                </div> <!-- end preview code-->
            </div> <!-- end tab-content-->
        </div> <!-- end card body-->
    </div> <!-- end card -->
    </div><!-- end col-->
    </div>

    </center>
    <!-- end row-->
    </div>
    <!-- end Content-->
    </div>
    <!-- END wrapper -->

    <script>
        //variable
        var col_array = [];
        var option = [];
        let i = 0;
        var _td = '';

        document.querySelector('#input_sw').addEventListener('change', (event) => {
            i = 0;
            clearOrderTbody();
            showOwner();
            showUST();
        });

        document.querySelector('#input_ust').addEventListener('change', (event) => {
            clearOrderTbody();
            showUS();
        });

        document.querySelector('#input_us').addEventListener('change', (event) => {
            clearOrderTbody();
            showOrder();
        });

        //function
        function clearOrderTbody() {
            $("#item_table tr").remove();
            document.getElementById('submitzone').style.display = "none";
        };

        function showOwner() {
            let input_sw = document.querySelector("#input_sw");
            let url = "{{ url('/api/ownerName') }}?input_sw=" + input_sw.value;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let input_owner = document.getElementById("input_owner");
                    let owner_name = result[0].owner_firstname + " " + result[0].owner_lastname;
                    input_owner.value = owner_name;
                });
        }

        function showUST() {
            let input_sw = document.querySelector("#input_sw");
            let url = "{{ url('/api/sw/USType') }}?input_sw=" + input_sw.value;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let input_ust = document.querySelector("#input_ust");
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item['ust_name'];
                        option.value = item['ust_id'];
                        input_ust.appendChild(option);
                    }
                });
        }

        function showUS() {
            let input_sw = document.querySelector("#input_sw");
            let input_ust = document.querySelector("#input_ust");
            let url = "{{ url('/api/US') }}?input_sw=" + input_sw.value + "&input_ust=" + input_ust.value;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let input_us = document.querySelector("#input_us");
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item['us_name'];
                        option.value = item['us_id'];
                        input_us.appendChild(option);
                    }
                });
        }

        function addcell(element) {
            var rowJavascript = element.parentNode.parentNode;
            var row = 0;
            row = rowJavascript.rowIndex - 1;
            // console.log(element);
            console.log(rowJavascript);
            console.log('pre_unit[' + row + '][' + col_array[row] + ']');
            var target = document.getElementById('pre_unit[' + row + '][' + col_array[row] + ']');
            col_array[row] = col_array[row] + 1;
            console.log(col_array);
            _td = '';
            _td = _td + '<div class="p-1" id="pre_unit[' + row + '][' + col_array[row] + ']"><select class="form-select form-control-light"';
            _td = _td + ' name="pre_unit[' + row + '][' + col_array[row] + ']">';
            _td = _td + '<option value = "">เลือกลำดับงานก่อนหน้า</option>';
            for (let op = 0; op <= option.length; op++) {
                if (row != op) {
                    _td = _td + option[op];
                }
            }
            _td = _td + '</select></div>';
            target.insertAdjacentHTML("afterend", _td);
        }

        function deletecell(element) {
            var rowJavascript = element.parentNode.parentNode.parentNode;
            var row = 0;
            row = rowJavascript.rowIndex - 1
            // console.log(element);
            // console.log(rowJavascript);
            console.log('pre_unit['+row+']['+col_array[row]+']');
            var target = document.getElementById('pre_unit[' + row + '][' + col_array[row] + ']');
            // console.log(target);
            if (col_array[row] > 0) {
                target.remove();
                col_array[row] = col_array[row] - 1;
            }
            console.log(col_array);
        }

        function showOrder() {
            let input_sw = document.querySelector("#input_sw");
            let input_us = document.querySelector("#input_us");
            let url1 = "{{ url('/api/getOrder') }}?input_sw=" + input_sw.value + "&input_us=" + input_us.value;
            fetch(url1)
                .then(response => response.json())
                .then(result => {
                    if (result.length != 0) {
                        document.getElementById('submitzone').style.display = "inline";
                        var o = 0;
                        var _a_op = 0;
                        console.log(result);
                        for (let item of result) {
                            if (_a_op != item['act_id']) {
                                option[o] = '<option value = "' + item['act_id'];
                                option[o] = option[o] + '">P' + item['sw_id'];
                                option[o] = option[o] + '-US' + item['fake_us_id'] + '-T' + item['fake_act_id'] + '</option>';
                                col_array.push(0);
                                o++;
                                _a_op = item['act_id'];
                            }
                        }
                        var _tr = '';
                        var _act = 0;
                        for (let activity of result) {
                            if (_act != activity['act_id']) {
                                if (_act != 0) {
                                    _tr = _tr + '</td><td><div class="p-1"></div><button type="button" id="add[' + i + ']" class="btn addbtn btn-primary btn-sm add" ';
                                    _tr = _tr + 'onclick="addcell(this)">';
                                    _tr = _tr + '<span class="glyphicon glyphicon-plus">เพิ่มลำดับงาน</span></button></div>';
                                    _tr = _tr + '<div class="p-1"><button type="button" id="delete[' + i + ']" class="btn addbtn btn-primary btn-sm add"';
                                    _tr = _tr + 'onclick="deletecell(this)">';
                                    _tr = _tr + '<span class="glyphicon glyphicon-plus">ลบลำดับงาน</span></button></div>';
                                    _tr = _tr + '</td></tr>';
                                    i++;
                                }
                                _tr = _tr + '<tr id="item_id[]"><td scope="row">P' + activity['sw_id'];
                                _tr = _tr + '-US' + activity['fake_us_id'] + '-T' + activity['fake_act_id'];
                                _tr = _tr + '</td><td style="text-align:start">' + activity['act_name'];
                                _tr = _tr + '<input type="hidden" class="form-control form-control-light"';
                                _tr = _tr + ' name="act_unit[' + i + ']" value = "' + activity['act_id'] + '"></td><td>';

                                _tr = _tr + '<div class="p-1" id="pre_unit[' + i + '][' + col_array[i] + ']" >';
                                _tr = _tr + '<select class="form-select form-control-light" name="pre_unit['+i+']['+col_array[i]+']"';
                                _tr = _tr + ' value = "' + activity['pre_id'] + '">';
                                _tr = _tr + '<option value = "">เลือกลำดับงานก่อนหน้า</option>';
                                console.log(activity['pre_id']);

                                var _check_op = '<option value = "' + activity['pre_id'];
                                _check_op = _check_op + '">P' + activity['sw_id'];
                                _check_op = _check_op + '-US' + activity['fake_us_id'] + '-T' + activity['f_pre_id'] + '</option>';
                                for (let op = 0; op <= option.length; op++) {
                                    if (i != op) {
                                        if (_check_op == option[op]) {
                                            _tr = _tr + '<option value = "' + activity['pre_id'];
                                            _tr = _tr + '" selected >P' + activity['sw_id'];
                                            _tr = _tr + '-US' + activity['fake_us_id'] + '-T' + activity['f_pre_id'] + '</option>';
                                        } else {
                                            _tr = _tr + option[op];
                                        }
                                    }
                                }
                                _tr = _tr + '</select></div>';
                                _act = activity['act_id'];
                            } else {
                                col_array[i] = col_array[i] + 1;
                                _tr = _tr + '<div class="p-1" id="pre_unit[' + i + '][' + col_array[i] + ']" >';
                                _tr = _tr + '<select class="form-select form-control-light" name="pre_unit[' + i + '][' + col_array[i] + ']"';
                                _tr = _tr + ' value = "' + activity['pre_id'] + '">';
                                _tr = _tr + '<option value = "">เลือกลำดับงานก่อนหน้า</option>';
                                console.log(activity['pre_id']);

                                var _check_op = '<option value = "' + activity['pre_id'];
                                _check_op = _check_op + '">P' + activity['sw_id'];
                                _check_op = _check_op + '-US' + activity['fake_us_id'] + '-T' + activity['f_pre_id'] + '</option>';
                                for (let op = 0; op <= option.length; op++) {
                                    if (i != op) {
                                        if (_check_op == option[op]) {
                                            _tr = _tr + '<option value = "' + activity['pre_id'];
                                            _tr = _tr + '" selected >P' + activity['sw_id'];
                                            _tr = _tr + '-US' + activity['fake_us_id'] + '-T' + activity['f_pre_id'] + '</option>';
                                        } else {
                                            _tr = _tr + option[op];
                                        }
                                    }
                                }
                                _tr = _tr + '</select></div>';
                                _act = activity['act_id'];
                            }
                        }
                        _tr = _tr + '</td><td><div class="p-1"></div><button type="button" id="add[' + i + ']" class="btn addbtn btn-primary btn-sm add" ';
                        _tr = _tr + 'onclick="addcell(this)">';
                        _tr = _tr + '<span class="glyphicon glyphicon-plus">เพิ่มลำดับงาน</span></button></div>';
                        _tr = _tr + '<div class="p-1"><button type="button" id="delete[' + i + ']" class="btn addbtn btn-primary btn-sm add"';
                        _tr = _tr + 'onclick="deletecell(this)">';
                        _tr = _tr + '<span class="glyphicon glyphicon-plus">ลบลำดับงาน</span></button></div>';
                        _tr = _tr + '</td></tr>';
                        $('#item_table').append(_tr);
                    } else {
                        showActivity();
                    }
                });
        }

        function showActivity() {
            let input_sw = document.querySelector("#input_sw");
            let input_us = document.querySelector("#input_us");
            let url = "{{ url('/api/Act') }}?input_us=" + input_us.value;

            fetch(url)
                .then(response => response.json())
                .then(result => {
                    if (result.length != 0) {
                        var o = 0;
                        for (let item of result) {
                            option[o] = '<option value = "' + item['act_id'];
                            option[o] = option[o] + '">P' + item['sw_id'];
                            option[o] = option[o] + '-US' + item['fake_us_id'] + '-T' + item['fake_act_id'] + '</option>';
                            col_array.push(0);
                            o++;
                        }
                        console.log(option);
                        console.log(col_array);

                        var _tr = '';

                        for (let activity of result) {

                            _tr = _tr + '<tr id="item_id[]"><td scope="row">P' + activity['sw_id'];
                            _tr = _tr + '-US' + activity['fake_us_id'] + '-T' + activity['fake_act_id'];
                            _tr = _tr + '</td><td>' + activity['act_name'];
                            _tr = _tr + '<input type="hidden" class="form-control form-control-light"';
                            _tr = _tr + ' name="act_unit[' + i + ']" value = "' + activity['act_id'] + '"></td><td>';

                            for (let j = 0; j <= col_array[i]; j++) {

                                _tr = _tr + '<div class="p-1" id="pre_unit[' + i + '][' + j + ']" ><select class="form-select form-control-light" name="pre_unit[' + i + '][' + j + ']">';
                                _tr = _tr + '<option value = "">เลือกลำดับงานก่อนหน้า</option>';

                                for (let op = 0; op <= option.length; op++) {
                                    if (i != op) {
                                        _tr = _tr + option[op];
                                    }
                                }
                                _tr = _tr + '</select></div>';
                            }
                            _tr = _tr + '</td><td><div class="p-1"></div><button type="button" id="add[' + i + ']" class="btn addbtn btn-primary btn-sm add" ';
                            _tr = _tr + 'onclick="addcell(this)">';
                            _tr = _tr + '<span class="glyphicon glyphicon-plus">เพิ่มลำดับงาน</span></button></div>';
                            _tr = _tr + '<div class="p-1"><button type="button" id="delete[' + i + ']" class="btn addbtn btn-primary btn-sm add"';
                            _tr = _tr + 'onclick="deletecell(this)">';
                            _tr = _tr + '<span class="glyphicon glyphicon-plus">ลบลำดับงาน</span></button></div>';
                            _tr = _tr + '</td></tr>';
                            i++;
                        }
                        $('#item_table').append(_tr);
                    } else {
                        var _tr = '';

                        _tr = _tr + '<tr><td colspan="4" style="text-align: center">';
                        _tr = _tr + '<small>ยังไม่มีข้อมูลงานในกิจกรรมนี้</small></td></tr>';

                        $('#item_table').append(_tr);
                    }
                });
        }
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