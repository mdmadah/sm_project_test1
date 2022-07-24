<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box px-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลโครงการ</a></li>
                        <li class="breadcrumb-item active">ข้อมูล User Story</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูล User Story
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addUserStory"
                        class="btn btn-success btn-sm ms-3">เพิ่มข้อมูล</a>
                </h4>
            </div>
        </div>
    </div>

    {{-- {{$searchByProjectID}}
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3 px-2">
                <label for="name" class="form-label">ชื่อโครงการ</label>
                <select class="form-select form-control-light" 
                    wire:model="searchByProjectID">
                    <option value="0">เลือกโครงการ</option>
                    @foreach ($softwares as $sw)
                        <option value="{{ $sw->id }}">{{ $sw->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-9"></div>
    </div> --}}
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
                                        <th style="text-align: center">รหัส</th>
                                        <th style="text-align: center">User story</th>
                                        <th style="text-align: center">User story type</th>
                                        <th style="text-align: center">ระยะเวลา</th>
                                        <th style="text-align: center">Priority</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($US->count() > 0)
                                        @foreach ($US as $row)
                                            <tr>
                                                <td>{{ $row->sw_name }}</td>
                                                <td>P{{ $row->sw_id }}-US{{ $row->fake_us_id }}</td>
                                                <td width='25%'>{{ $row->us_name }}</td>
                                                <td style="text-align: center">{{ $row->at_name }}</td>
                                                <td style="text-align: center">{{ $row->us_duration }}</td>
                                                <td style="text-align: center">
                                                    @if ($row->prio_name == 'Low')
                                                        <div class="badge bg-success mb-3">
                                                            {{ $row->prio_name }}
                                                        </div>
                                                    @elseif ($row->prio_name == 'Medium')
                                                        <div class="badge bg-warning mb-3">
                                                            {{ $row->prio_name }}
                                                        </div>
                                                    @else
                                                        <div class="badge bg-danger mb-3">
                                                            {{ $row->prio_name }}
                                                        </div>
                                                    @endif
                                                    
                                                </td>

                                                <td style="text-align: center">
                                                    <select class="custom-select" id="inputGroupSelect01" value = "{{$row->us_status}}">
                                                        <option value="0">กำลังดำเนินการ</option>
                                                        <option value="1">รอการอนุมัติ</option>
                                                        <option value="2">ไม่ได้ใช้งาน</option>
                                                        <option value="3">รอการดำเนินการ</option>
                                                        <option value="4">ดำเนินการเสร็จสิ้น</option>
                                                    </select>

                                                    {{-- @if ($row->us_status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $row->fake_us_id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $row->fake_us_id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $row->fake_us_id }}" data-on-label="On"
                                                        data-off-label="Off"></label> --}}
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary my-1"
                                                        wire:click="viewUserStoryDetails({{ $row->fake_us_id }})">
                                                        <i class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editUserStory({{ $row->fake_us_id }})">
                                                        <i class="mdi mdi-pencil"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="12" style="text-align: center">
                                                <h5>ยังไม่มีข้อมูลขณะนี้ กรุณาเลือกโครงการ</h5>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if (count($US))
                                {{ $US->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addUserStory" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูล User Story</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeuserstoryData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ชื่อโครงการ</label>
                                                <select id="input_sw" class="form-select form-control-light" onclick="showCompa()"
                                                    wire:model="sw_id">
                                                    <option value="">เลือกโครงการ</option>
                                                    @foreach ($softwares as $sw)
                                                        <option value="{{ $sw->id }}"
                                                            wire:key="sw_id-{{ $sw->id }}">{{ $sw->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title"
                                                    class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>
                                                <input type="text" id="input_company" disabled
                                                    class="form-control form-control-light" wire:model="input_company">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">User Story</label>
                                                <input type="text" id="input_userstory"
                                                    class="form-control form-control-light"
                                                    wire:model="input_userstory">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">User Story Type</label>
                                                <select id="input_ust_id_1" name="at_id"
                                                    class="form-select form-control-light" wire:model="input_ust_id">
                                                    <option value="">เลือกประเภทของกิจกรรม</option>
                                                    @foreach ($act_types as $ust)
                                                        <option value="{{ $ust->id }}"
                                                            wire:key="sw_id-{{ $ust->id }}">{{ $ust->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ระยะเวลา (วัน)</label>
                                                <input type="number" id="duration" name="duration"
                                                    class="form-control form-control-light"  wire:model="duration">
                                                @error('duration')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="" class="py-2">
                                                    <input type="checkbox" name="" id="chkPERT_1"
                                                        onclick="calPERT(this)" >
                                                    คำนวณด้วย PERT
                                                </label>
                                                <br/>
                                                <span id="errorPERT"  style="color: crimson; visibility:hidden;">*กรุณาเลือกประเภทของกิจกรรม</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Priority</label>
                                                <select id="prio_id" name="prio_id"
                                                    class="form-select form-control-light" wire:model="prio_id">
                                                    <option value="">เลือก Priority</option>
                                                    @foreach ($priorities as $p)
                                                        <option value="{{ $p->id }}"
                                                            wire:key="sw_id-{{ $p->id }}">{{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณ</label>
                                                <input type="number" id="us_budget"
                                                    class="form-control form-control-light" wire:model="us_budget">
                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Modal -->

        <!-- Edit Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="editUserStory" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูล User Story</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editUserStoryData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ชื่อโครงการ</label>
                                                <select id="input_sw" class="form-select form-control-light"
                                                    wire:model="sw_id">
                                                    <option value="" disabled>เลือกโครงการ</option>
                                                    @foreach ($softwares as $sw)
                                                        <option value="{{ $sw->id }}"
                                                            wire:key="sw_id-{{ $sw->id }}">{{ $sw->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title"
                                                    class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>
                                                <input type="text" id="input_company"
                                                    class="form-control form-control-light"
                                                    wire:model="input_company">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">User Story</label>
                                                <input type="text" id="input_userstory"
                                                    class="form-control form-control-light"
                                                    wire:model="input_userstory">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">User Story Type</label>
                                                <select id="input_ust_id_2" name="at_id"
                                                    class="form-select form-control-light" wire:model="input_ust_id">
                                                    <option value="" disabled>เลือกประเภทของกิจกรรม</option>
                                                    @foreach ($act_types as $ust)
                                                        <option value="{{ $ust->id }}"
                                                            wire:key="sw_id-{{ $ust->id }}">{{ $ust->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ระยะเวลา (วัน)</label>
                                                <input type="number" id="duration" name="duration"
                                                    class="form-control form-control-light" wire:model="duration"
                                                    value="0">
                                                @error('duration')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <label for="" class="py-2">
                                                    <input type="checkbox" name="" id="chkPERT_2"
                                                        onclick="calPERT(this)" />
                                                    คำนวณด้วย PERT
                                                </label>
                                                <span id="errorPERT"  style="color: crimson; visibility:hidden;">*กรุณาเลือกประเภทของกิจกรรม</span>
                                                <br/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Priority</label>
                                                <select id="prio_id" name="prio_id"
                                                    class="form-select form-control-light" wire:model="prio_id">
                                                    <option value="" disabled>เลือก Priority</option>
                                                    @foreach ($priorities as $p)
                                                        <option value="{{ $p->id }}"
                                                            wire:key="sw_id-{{ $p->id }}">{{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณ</label>
                                                <input type="number" id="us_budget"
                                                    class="form-control form-control-light" wire:model="us_budget">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-3"></label>
                                <div class="col-9 text-end">
                                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Modal -->

        <!-- View Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="viewUserStory" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูล PERT</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewUserStoryModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>ชื่อโครงการ</th>
                                    <td>{{ $view_sw_name }}</td>
                                </tr>

                                <tr>
                                    <th>รหัส</th>
                                    <td>{{ $view_us_id }}</td>
                                </tr>

                                <tr>
                                    <th>User story</th>
                                    <td>{{ $view_us }}</td>
                                </tr>

                                <tr>
                                    <th>ประเภทของ User story</th>
                                    <td>{{ $view_ust }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลา</th>
                                    <td>{{ $view_du }}</td>
                                </tr>

                                <tr>
                                    <th>Priority</th>
                                    <td>{{ $view_priority }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End View Modal -->

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addUserStory').modal('hide');
            $('#editUserStory').modal('hide');
            $('#viewUserStory').modal('hide');
            document.getElementById("errorPERT").style.visibility = "hidden";
            document.getElementById("chkPERT_1").checked = false;
            document.getElementById("chkPERT_2").checked = false;

        });

        window.addEventListener('show-edit-UserStory-modal', event => {
            $('#editUserStory').modal('show');
        });

        window.addEventListener('show-view-UserStory-modal', event => {
            $('#viewUserStory').modal('show');
        });
    </script>


    <script>
        
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

    <script type="text/javascript">

        document.querySelector('#input_ust_id_1').addEventListener('change', (event) => {
            if(document.getElementById("input_ust_id_1").value!=''){
                document.getElementById("errorPERT").style.visibility = "hidden";
                calPERT(document.getElementById("chkPERT_1"));
            }else{
                document.getElementById("chkPERT_1").checked = false;
            }
        });
        document.querySelector('#input_ust_id_2').addEventListener('change', (event) => {
            if(document.getElementById("input_ust_id_2").value!=''){
                document.getElementById("errorPERT").style.visibility = "hidden";
                calPERT(document.getElementById("chkPERT_2"));
            }else{
                document.getElementById("chkPERT_2").checked = false;
            }
        });
        // if(document.getElementById("input_ust_id").value!=''){
        //     document.getElementById("errorPERT").style.visibility = "hidden";
        // }
        function calPERT(element) {

            console.log("hey");
            if(element.checked == true){
                if(element.id == "chkPERT_1"){
                    if (document.getElementById("input_ust_id_1").value!='') {
                        document.getElementById("errorPERT").style.visibility = "hidden";
                        Livewire.emit('getPERTforInput', document.getElementById("input_ust_id_1").value);
                    } else {
                        // console.log(element);
                        document.getElementById("errorPERT").style.visibility = "visible";

                        element.checked = false;
                    }
                }else{
                    if (document.getElementById("input_ust_id_2").value!='') {
                        document.getElementById("errorPERT").style.visibility = "hidden";
                        Livewire.emit('getPERTforInput', document.getElementById("input_ust_id_2").value);
                    } else {
                        // console.log(element);
                        document.getElementById("errorPERT").style.visibility = "visible";

                        element.checked = false;
                    }
                }
                
            }else{
                document.getElementById("duration").value = 0;

                
            }
            

        }
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
                    url: "{{ url('/api/updateStatusUserStory') }}",

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
@endpush
