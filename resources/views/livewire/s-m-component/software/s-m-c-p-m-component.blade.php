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

    <style>
        .disable-check{padding-left:1.612em;}
        .disable-check-icon{
            float:left;margin-left:-1.112em;
            width:1.112em;height:1.112em;margin-top:-.194em;vertical-align:top;
            font-size: 1.4em;
        }
        .fornum{
            font-size: 1em; 
            padding: 0em 0.3em; 
            margin: -2px 0; 
            width: 1.7em; 
            text-align: center;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            
            @include('sweetalert::alert')
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
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">การจัดการข้อมูลโครงการ</a></li>
                                    <li class="breadcrumb-item active">การวิเคราะห์ด้วย CPM</li>
                                </ol>
                            </div>
                            <h4 class="page-title">การวิเคราะห์ด้วย CPM
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#add-new-task-modal" class="btn btn-success btn-sm ms-3">Add New</a> --}}
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                {{-- start Row --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ชื่อโครงการ</label>
                            <select class="form-select form-control-light custom-select" name="sw_id" id="input_sw">
                                <option value="">เลือกโครงการ</option>
                                @foreach ($softwares as $sw)
                                    <option value="{{ $sw->id }}">{{ $sw->name }}</option>
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
                            <select class="form-select form-control-light custom-select" id="input_ust">
                                <option value="">เลือกประเภทกิจกรรม</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">User Story</label>
                        <select class="form-select form-control-light custom-select" name="us_id" id="input_us">
                            <option value="">เลือก User Story</option>
                        </select>
                    </div>
                </div>
                
                {{-- style="display:none" --}}
                <div class="row">
                    <div class="col-md-9" id="showOrder" style="display:none">
                        <div class="row">
                            <h4 class="page-title px-5 py-2">ลำดับงานทั้งหมด</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="responsive-preview">
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="col-md-2" scope="col">รหัส</th>
                                                        <th class="col-md-4" scope="col"style="width: 25%">ชื่องาน</th>
                                                        <th class="col-md-4" scope="col">ลำดับงานก่อนหน้า</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_order">
                                             
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                    </div> <!-- end preview-->

                                    <div class="row">
                                        <div class="text-end py-2 px-4">
                                            <button  type="button" class="btn btn-primary"
                                            onclick="calculate()">วิเคราะห์ด้วย CPM</button>
                                        </div>
                                    </div>


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
                        </div>
                    </div>

                    <div class="col-md-12" id="showCPM" style="display:none">
                        <form class="p-2" method="POST" action="{{ route('AccelerateProject') }}" id="CPMform">

                        @csrf    
                            <div class="row">
                                <h4 class="page-title px-4 py-2">ผลการวิเคราะห์ด้วย CPM</h4>
                            </div>
                            <input type="hidden" name="sw_id" id="cpm_sw_id">
                            <input type="hidden" name="us_id" id="cpm_us_id">
                            
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="responsive-preview">
                                            <div class="table-responsive">
                                                <table class="table mb-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col-md-2">รหัส</th>
                                                            <th scope="col-md-3">ชื่องาน</th>
                                                            <th scope="col-md-2">วันที่เร่งได้</th>
                                                            <th scope="col-md-2">ค่าใช้จ่าย/วัน</th>
                                                            <th style="width: 20%">การเร่งงาน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_cpm">

                                                    </tbody>
                                                </table>
                                            </div> <!-- end table-responsive-->
                                        </div> <!-- end preview-->

                                        <div class="row py-3 px-5 d-flex justify-content-end" style="height: 80px;">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-auto">
                                                <div class="mb-3 my-1">
                                                    <label for="task-title"
                                                    class="form-label">ค่าใช้จ่ายรวมทั้งหมด</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="mb-2 ">
                                                    <input readonly type="text" id="sum_cost" value="0"
                                                        class="form-control form-control-light text-center">
                                                </div>
                                            </div>

                                            <div class="col-md-auto">
                                                <div class="mb-2 my-1">
                                                    <label for="task-title"
                                                        class="form-label" style="margin-right: 0em">บาท</label>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-auto">
                                                <div class="mb-2">
                                                    <button type="button" onclick="sConsole()" class="btn btn-primary">ยืนยัน</button>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-auto">
                                                <div class="mb-2">
                                                    <button type="submit"  class="btn btn-primary">ยืนยัน</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                                                                
                                    </div> <!-- end tab-content-->
                                </div> <!-- end card body-->
                            </div>
                        </form>
                    </div>
                </div>
                {{-- end table show cpm data --}}

            </div>
            {{-- </center> --}}
            <!-- end row-->

        </div>
        <!-- end Content-->
    </div>
    <!-- END wrapper -->

    <script>
        //variable
        var id_array = [];
        var day_array = [];
        var cost_array = [];
        let i = 0;     

        document.querySelector('#input_sw').addEventListener('change', (event) => {
            showOwner();
            showUST();
            clearOrderTbody();
            clearCPMTbody();
            document.querySelectorAll('#input_ust option').forEach(option => option.remove());
            document.querySelector("#input_ust").appendChild(new Option('เลือกประเภทกิจกรรม',null));
            document.querySelectorAll('#input_us option').forEach(option => option.remove());
            document.querySelector("#input_us").appendChild(new Option('เลือก User Story',null));

        });

        document.querySelector('#input_ust').addEventListener('change', (event) => {
            showUS();
            clearOrderTbody();
            document.querySelectorAll('#input_us option').forEach(option => option.remove());
            document.querySelector("#input_us").appendChild(new Option('เลือก User Story',null));
        });

        document.querySelector('#input_us').addEventListener('change', (event) => {
            showActivity();
        });

        //functions
        function sConsole() {
            // event.preventDefault();
            // CPMform
            var length = document.getElementById("CPMform").elements.length;
            for (let index = 0; index < length; index++) {
                console.log(" name="+document.getElementById("CPMform").elements[index].name+" value="+document.getElementById("CPMform").elements[index].value);
                
            }
        }

        function addDay(element) {
            var rowJavascript = (element.parentNode.parentNode.parentNode.parentNode);
            var row = 0;
            row = (rowJavascript.rowIndex) - 1;
            if (element.checked == true){
                document.getElementById('day2['+row+']').remove();
                let = _input = '<div class="row" style="padding: 0em -5em;"><div><input type="number" id = "number['+row+']"';
                _input = _input + 'class="form-control fornum" min="1" max="'+day_array[row];
                _input = _input + '" name = "day2['+row+']" value = "'+day_array[row]+'"></div>';
                _input = _input + '<span class="mx-2" style="margin: -20px 0px;">วัน</span></div>';
                console.log("fffffff"+element.parentNode.outerHTML);
                console.log(id_array);
                console.log(day_array);
                console.log(row);
                element.parentNode.insertAdjacentHTML("afterend", _input);
            } else {
                console.log(id_array);
                console.log(day_array);
                console.log(row);
                document.getElementById('number['+row+']').parentNode.parentNode.remove();
                element.parentNode.insertAdjacentHTML("afterend", '<input type="hidden" id = "day2['+row+']" name = "day2['+row+']" value="0">');
            }
            calSumCost();
        }
        function calSumCost() {
            var sum_cost = 0;
            for (let s = 0; s < cost_array.length; s++) {
                sum_cost = sum_cost + (document.getElementsByName('day2['+s+']')[0].value)*(cost_array[s]);
            }
            document.getElementById('sum_cost').value = sum_cost;
        }
        
        function clearOrderTbody() {
            $("#tbody_order tr").remove();
            $("#showOrder")[0].style.display = "none";
        };

        function clearCPMTbody() {
            $("#tbody_cpm tr").remove();
            $("#showCPM")[0].style.display = "none";
        };

        function showOwner() {

            let input_sw = document.querySelector("#input_sw");
            if(input_sw.value == ''){
                document.getElementById("input_owner").value = '';
            }else{
                let url = "{{ url('/api/ownerName') }}?input_sw=" + input_sw.value;
                fetch(url)
                    .then(response => response.json())
                    .then(result => {
                        console.log(result);
                        document.getElementById("input_owner").value = result[0].owner_firstname + " " + result[0].owner_lastname;
                    });
            }
        
        }

        function showUST() {
            let input_sw = document.querySelector("#input_sw");
            let url = "{{ url('/api/cpm/USType') }}?input_sw=" + input_sw.value;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    // console.log(result);
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
            let input_ust = document.querySelector("#input_ust");
            let input_sw = document.querySelector("#input_sw");
            let url = "{{ url('/api/cpm/US') }}?input_sw=" + input_sw.value + "&input_ust=" + input_ust.value;

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

        function showActivity() {
            // submitbtn.style.visibility = "visible";
            let input_us = document.querySelector("#input_us");
            let input_sw = document.querySelector("#input_sw");
            var _tr = '';
            let url = "{{ url('/api/cpm/Act') }}?input_sw=" + input_sw.value + "&input_us=" + input_us.value;
            // let url = "{{ url('/api/cpm/Act') }}?input_sw=" + 1 + "&input_us=" + 1;

            fetch(url)
                .then(response => response.json())
                .then(result => {

                    // console.log(result);
                    var actID = 0;
                    for (let order of result) {

                        if (actID != order['act_id']) {

                            if (actID > 0) {
                                _tr = _tr + '"></td></tr>';
                                // </td>
                                // </tr>">
                            }
                            _tr = _tr + '<tr><th scope="row">P' + order['sw_id'];
                            _tr = _tr + '-US' + order['us_id'] + '-T' + order['act_id'];
                            _tr = _tr + '</th><td style="text-align: start">' + order['act_name'] + '</td>';
                            _tr = _tr +
                                '<td><input readonly type="text" class="form-control form-control-light text-center"';
                            _tr = _tr + 'value="'

                            if (order['pre_id'] == null) {

                                _tr = _tr + 'ไม่มีลำดับก่อนหน้า';

                            } else {

                                _tr = _tr + 'P' + order['sw_id'] + '-US' + order['us_id'] + '-T' + order['pre_id'];

                            }
                        } else {
                            _tr = _tr + ' ,P' + order['sw_id'] + '-US' + order['us_id'] + '-T' + order['pre_id'];


                        }

                        actID = order['act_id'];

                    }

                    _tr = _tr + '"></td></tr>';

                    $('#tbody_order').append(_tr);
                    $("#showOrder")[0].style.display = "inline";


                });

        }

        function calculate() {
            clearOrderTbody();
            let input_us = document.querySelector("#input_us");
            let input_sw = document.querySelector("#input_sw");
            document.getElementById('cpm_sw_id').value = input_sw.value;
            document.getElementById('cpm_us_id').value = input_us.value;
            let url = "{{ url('/api/cpm/cal') }}?input_sw=" + input_sw.value+"&input_us=" + input_us.value;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    var _div = '';
                    for (let cpm of result) {
                        _div = _div +'<tr><th scope="row">P'+cpm['sw_id'];
                        _div = _div+'-US'+cpm['us_id']+'-T'+cpm['f_act_id'];
                        _div = _div+'<input type="hidden" name = "id['+i+']" value="'+cpm['act_id']+'"></th>';
                        _div = _div+'<td>'+cpm['name']+'</td>';
                        _div = _div+'<td>'+cpm['rush_day']+'</td>';
                        _div = _div+'<td>'+cpm['rush_cost']+'</td><td>';
                        _div = _div+'<div class="form-check d-flex justify-content-center">';
                        if(cpm['rush_day'] <= 0)
                        {
                            _div = _div+'<i class = "mdi mdi-close-box disable-check-icon"></i>';
                            _div = _div+'<span class="mx-2">เร่งงาน</span>';
                            _div = _div+'<input type="hidden" id = "day2['+i+']" name = "day2['+i+']" value="0">';
                        }
                        else{
                            _div = _div+'<div><input type="checkbox" class="form-check-input" onclick="addDay(this)">';
                            _div = _div+'<span class="mx-2">เร่งงาน</span></div>';
                            _div = _div+'<input type="hidden" id = "day2['+i+']" name = "day2['+i+']" value="0">';
                        }
                        id_array[i] = cpm['act_id'];
                        day_array[i] = cpm['rush_day'];
                        cost_array[i] = cpm['rush_cost'];
                        i++;
                        _div = _div+'</div></td></tr>';
                        }
                    console.log(id_array);
                    console.log(day_array);
                    $('#tbody_cpm').append(_div);
                    $("#showCPM")[0].style.display = "inline"; 
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
    <!-- sweet alert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- end sweet alert-->
</body>

</html>
