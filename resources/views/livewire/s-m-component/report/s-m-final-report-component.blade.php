<div class="row">
    <div class="form-group col-md-11">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3" style="padding-top: 20px">
                    <label for="name" class="form-label">ชื่อโครงการ</label>
                    <select id="input_sw" class="form-select form-control-light">
                        <option value="">เลือกโครงการ</option>
                        @foreach ($softwares as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="mb-3" style="padding-top: 20px">
                    <label for="task-title" class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>
                    <input type="text" id="input_company" disabled class="form-control form-control-light">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

<div class="container" id="softwareHistory" style="display: none;">
    <div class="row">
        <div class="col-md-10" style="padding-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td>วันที่ทำสัญญา</td>
                            <td style="width: 20%">
                                <input type="text" id="signDate" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&emsp;ระยะเวลาดำเนินการ</td>
                            <td style="width: 10%">
                                <input type="text" id="duration" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&emsp;เดือน</td>
                            <td>&emsp;วันที่เริ่มต้นโครงการ</td>
                            <td>
                                <input type="text" id="startDate" disabled
                                    class="form-control form-control-light">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td>วันที่ปิดโครงการ</td>
                            <td style="width: 20%">
                                <input type="text" id="endDate" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td style="width: 12%"></td>
                            <td>&emsp;ระยะเวลาในการพัฒนาจริง</td>
                            <td style="width: 15%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;เดือน</td>
                            <td style="width: 10%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;วัน</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td>ลักษณะการปิดโครงการ</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td>งบประมาณสัญญา</td>
                            <td style="width: 15%">
                                <input type="text" id="allBudget" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;บาท</td>
                            <td>&emsp;งบประมาณที่คาดหวัง</td>
                            <td style="width: 15%">
                                <input type="text" id="expectedBudget" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;บาท</td>
                            <td>&emsp;งบประมาณที่ใช้จริง</td>
                            <td style="width: 15%">
                                <input type="text" id="usedBudget" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;บาท</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td>ผู้รับชอบโครงการ</td>
                            <td style="width: 20%">
                                <input type="text" id="sm_name" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td style="width: 68%"></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="rushHistory">
    <div class="row">
        <div class="col-md-10" style="padding-top: 20px;">
            <div class="card">
                <div class="card-body">

                    <table>
                        <tr>
                            <td>ประวัติการเร่งงาน</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 13%"></td>
                            <td>P1-US01-T02&emsp;</td>
                            <td style="width: 20%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td style="width: 16%"></td>
                            <td>&emsp;จำนวนวันที่เร่ง</td>
                            <td style="width: 10%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&emsp;วัน&emsp;</td>
                            <td style="width: 10%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;บาท</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 68%"></td>
                            <td>รวมค่าใช้จ่ายเพิ่มเติม</td>
                            <td style="width: 15%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td>&nbsp;บาท</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="lateHistory">
    <div class="row">
        <div class="col-md-10" style="padding-top: 20px;">
            <div class="card">
                <div class="card-body">

                    <table>
                        <tr>
                            <td>ประเภทงานที่ล่าช้า</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td style="width: 20%"></td>
                            <td style="width: 20%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td style="width: 10%"></td>
                            <td>&emsp;ผู้รับผิดชอบ</td>
                            <td style="width: 20%">
                                <input type="text" id="input_company" disabled
                                    class="form-control form-control-light">
                            </td>
                            <td style="width: 20%"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // showCompa
        function showCompa() {
            let input_sw = document.querySelector("#input_sw");
            console.log("hey");
            let url = "{{ url('/api/company') }}?input_sw=" + input_sw.value;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    let input_company = document.getElementById("input_company");
                    // input_zipcode.value = "";
                    for (let item of result) {
                        input_company.value = item.organ_name_th;
                        break;
                    }
                });
        }
        document.querySelector('#input_sw').addEventListener('change', (event) => {
            showCompa();
        });
    </script>
    <script>
        function showReport() {
            let input_sw = document.querySelector("#input_sw");
            console.log("Show");
            let url = "{{ url('/api/finalreport') }}?input_sw=" + input_sw.value;
            console.log(url);
            if(document.getElementById("input_sw").value != null){
                document.getElementById("softwareHistory").style.display = "inline";
            }else{
                document.getElementById("softwareHistory").style.display = "inline";
            }
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    let signDate = document.getElementById("signDate");
                    let startDate = document.getElementById("startDate");
                    let endDate = document.getElementById("endDate");
                    let duration = document.getElementById("duration");
                    let usedBudget = document.getElementById("usedBudget");
                    let expectedBudget = document.getElementById("expectedBudget");
                    let allBudget = document.getElementById("allBudget");
                    let sm_name = document.getElementById("sm_name");
                    // input_zipcode.value = "";
                    for (let item of result) {
                        signDate.value = item.signDate;
                        startDate.value = item.startDate;
                        endDate.value = item.endDate;
                        duration.value = item.duration;
                        usedBudget.value = item.usedBudget;
                        expectedBudget.value = item.expectedBudget;
                        allBudget.value = item.allBudget;
                        sm_name.value = item.sm_firstname+' '+item.sm_lastname;
                        break;
                    }
                });
        }
        document.querySelector('#input_sw').addEventListener('change', (event) => {
            showReport();
        });
    </script>
@endpush
