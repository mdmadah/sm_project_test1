<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลโครงการ</a></li>
                        <li class="breadcrumb-item active">ข้อมูลงานใน User Story</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลงานใน User Story
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addSoftware"
                        class="btn btn-success btn-sm ms-3">เพิ่มข้อมูล</a>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success text-center">{{ session('message') }}</div>
                            @endif
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">ชื่อโครงการ</th>
                                        <th style="text-align: center">User Story</th>
                                        <th style="text-align: center">รหัส</th>
                                        <th style="text-align: center">ชื่องาน</th>
                                        <th style="text-align: center">ผู้รับชอบงาน</th>
                                        <th style="text-align: center">ระยะเวลาที่ใช้ปกติ</th>
                                        <th style="text-align: center">จำนวนวันที่เร่งได้</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($Act->count() > 0)
                                        @foreach ($Act as $row)
                                            <tr>
                                                <td style="text-align: center">{{ $row->sw_name }}</td>
                                                <td style="text-align: center">{{ $row->us_name }}</td>
                                                <td style="text-align: center">
                                                    P{{ $row->sw_id }}-US{{ $row->fake_us_id }}-T{{ $row->fake_act_id }}
                                                </td>
                                                <td style="text-align: center">{{ $row->act_name }}</td>
                                                <td style="text-align: center">{{ $row->ts_firstname }}
                                                    {{ $row->ts_lastname }}</td>
                                                <td style="text-align: center">{{ $row->act_NT }}</td>
                                                <td style="text-align: center">{{ $row->act_rush_day }}</td>

                                                <td style="text-align: center">
                                                    @if ($row->status == 0)
                                                        <input type="checkbox" class="switch" id="{{ $row->sw_id }}"
                                                            checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch" id="{{ $row->sw_id }}"
                                                            data-switch="bool">
                                                    @endif
                                                    <label for="{{ $row->sw_id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewSoftwareDetails({{ $row->sw_id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editSoftware({{ $row->sw_id }})"><i
                                                            class="mdi mdi-pencil"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center">
                                                <small>ยังไม่มีข้อมูลขณะนี้</small>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if (count($Act))
                                {{ $Act->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addSoftware" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูลงานใน User Story</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storesoftwareData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ชื่อโครงการ</label>
                                                <div>
                                                    <input type="text" id="input_sw"
                                                        class="form-control form-control-light" wire:model="input_sw">
                                                    @error('name')
                                                        <span class="text-danger"
                                                            style="font-size: 11.5px">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title"
                                                    class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>
                                                <input type="text" id="input_company"
                                                    class="form-control form-control-light" disabled id="input_company">
                                            </div>
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
                                            <select class="form-select form-control-light" name="us_id"
                                                id="input_us">
                                                <option>เลือก User Story</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-3"></label>
                                <div class="col-9 text-end">
                                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                </div>
                            </div>

                        </form>

                        {{-- @include('livewire.form-dropdown.p-e-r-t-dropdown') --}}
                        {{-- <livewire:form-dropdown.p-e-r-t-dropdown /> --}}

                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Modal -->

    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addSoftware').modal('hide');
            $('#editSoftware').modal('hide');
            $('#viewSoftware').modal('hide');
        });

        window.addEventListener('show-edit-software-modal', event => {
            $('#editSoftware').modal('show');
        });

        window.addEventListener('show-view-software-modal', event => {
            $('#viewSoftware').modal('show');
        });

        // close modal on click outside at anywhere
        document.addEventListener(
            "click",
            function(event) {
                // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
                if (
                    // event.target.matches(".btn-close") ||
                    event.target.closest("#editSoftware") && $('#editSoftware').modal('hide')
                ) {
                    console.log("asggwrgeoirgwoieghpwirgjpwrogpiwrjgirgirjgirjgporjpgijrigj");
                    // Livewire.emit('closeEditSoftwareModal')
                    // {{ $this->closeEditSoftwareModal() }}
                    console.log("Call Call");
                }
            },
            false
        )
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.switch').change(function() {
                // this will contain a reference to the checkbox

                let id = this.id;
                let status = 1;

                if (this.checked) {
                    console.log(this.id);
                    status = 0;
                    // the checkbox is now checked 
                } else {
                    console.log(this.id);
                    // the checkbox is now no longer checked
                }
                // console.log("{{ url('/api/updateNameTitle') }}");

                $.ajax({
                    url: "{{ url('/api/updateStatusPert') }}",

                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id,
                        status
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>

<script>
    //variable
    var row = 0;
    var option = '';
    var _tr = '';
    getTr();

    //Lets start!
    document.querySelector('#input_sw').addEventListener('change', (event) => {
        showUST();
        showCompany();
    });
    document.querySelector('#input_ust').addEventListener('change', (event) => {
        
        showUS();
    });
    document.querySelector('#input_us').addEventListener('change', (event) => {
        var btnzone = document.getElementById("btnzone");
        btnzone.style.visibility = "visible";
          
        row = row+1;
        $('#item_table').append(_tr);
           
    });
    var addbtn = document.getElementById("add");
    addbtn.addEventListener("click", function() {
        row = row+1;
        $('#item_table').append(_tr);
    });

    //function
    function showUST() {
        let input_sw = document.querySelector("#input_sw");
        // console.log(input_sw.value);
        let url = "{{ url('/api/sw/USType') }}?input_sw=" + input_sw.value;
        // console.log(url);
        fetch(url)
            .then(response => response.json())
            .then(result => {
                console.log(result);
                let input_ust = document.querySelector("#input_ust");
                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item['ust_name'];
                    option.value = item['ust_id'];

                    input_ust.appendChild(option);
                }
                // showCompany();
            });
    }

    function showCompany() {

        let input_sw = document.querySelector("#input_sw");
        // console.log("hey2");
        let url = "{{ url('/api/company') }}?input_sw=" + input_sw.value;
        // console.log(url);
        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                let input_company = document.getElementById("input_company");
                // input_zipcode.value = "";
                for (let item of result) {
                    input_company.value = item.organ_name_th;
                    break;
                }
            });
    }

    function showUS() {
        let input_ust = document.querySelector("#input_ust");
        // console.log("hey3");
        let url = "{{ url('/api/US') }}?input_ust=" + input_ust.value;
        // console.log(url);
        fetch(url)
            .then(response => response.json())
            .then(result => {

                let input_us = document.querySelector("#input_us");
                // input_ust.innerHTML = '<option value="">กรุณาเลือกเขต/อำเภอ</option>';
                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item['us_name'];
                    option.value = item['us_id'];

                    input_us.appendChild(option);
                }
            });
    }

    function getTr() {
        
        let url = "{{ url('/api/team') }}";
        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                for (let item of result) {
                    option = option + '<option value = "' + item['id'];
                    option = option + '">' + item['firstname'];
                    option = option + item['lastname'] + '</option>';
                }

                

                _tr = _tr + '<tr><td>';
                _tr = _tr + '<div class="row"><div class="col-md-6"><div class="mb-3">';
                _tr = _tr + '<label for="task-title" class="form-label">ชื่องาน</label>';
                _tr = _tr + '<input type="text" name="item_name[]"';
                _tr = _tr + 'class="form-control form-control-light" id="task-title">';
                _tr = _tr + '</div></div>';

                _tr = _tr + '<div class="col-md-6"><div class="mb-3">';
                _tr = _tr + '<label class="form-label">ผู้รับชอบงาน</label>';
                _tr = _tr + '<select class="form-select form-control-light" name="item_ts_id[]">';
                _tr = _tr + '<option value="">เลือกผู้รับผิดชอบงาน</option>';
                _tr = _tr + option + '</select></div></div></div>';

                
                _tr = _tr + '<div class="row">';
                _tr = _tr + '<div class="col-md-3"><div class="mb-3">';
                _tr = _tr + '<label for="task-title" class="form-label">ระยะเวลาที่ใช้ปกติ (วัน)</label>';
                _tr = _tr + '<input type="text" name="item_NT[]" class="form-control form-control-light"';
                _tr = _tr + 'id="task-title"></div></div>';
                _tr = _tr + '<div class="col-md-3"><div class="mb-3">';
                _tr = _tr + '<label for="task-title" class="form-label">จำนวนวันที่เร่งได้</label>';
                _tr = _tr + '<input type="text" name="item_rush_day[]" class="form-control form-control-light"';
                _tr = _tr + 'id="task-title"></div></div>';
                _tr = _tr + '<div class="col-md-3"><div class="mb-3">';
                _tr = _tr + '<label for="task-title" class="form-label">งบประมาณในการเร่งงานต่อวัน</label>';
                _tr = _tr + '<input type="text" name="item_rush_cost_per_day[]" class="form-control form-control-light"';
                _tr = _tr + 'id="task-title"></div></div></div>';
                
                _tr = _tr + '</td></tr>';
            });

    }
</script>

@endpush
