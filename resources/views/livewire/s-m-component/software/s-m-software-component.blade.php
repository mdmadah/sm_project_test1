<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box px-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลโครงการ</a></li>
                        <li class="breadcrumb-item active">ข้อมูลโครงการ</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลโครงการ
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
                                        <th style="text-align: center">รหัส</th>
                                        <th style="text-align: center">ชื่อโครงการ</th>
                                        <th style="text-align: center">เจ้าของโครงการ</th>
                                        <th style="text-align: center">ผู้รับชอบโครงการ</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($softwares->count() > 0)
                                        @foreach ($softwares as $software)
                                            <tr>
                                                <td style="text-align: center">{{ ++$i }}</td>
                                                <td style="text-align: center">{{ $software->sw_name }}</td>
                                                <td style="text-align: center">{{ $software->ow_firstname }}
                                                    {{ $software->ow_lastname }}</td>
                                                <td style="text-align: center">{{ $software->sm_firstname }}
                                                    {{ $software->sm_lastname }}</td>
                                                {{-- {{$software->sw_status }} --}}
                                                <td style="text-align: center">
                                                    @if ($software->sw_status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $software->sw_id }}" checked data-switch-software="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $software->sw_id }}" data-switch-software="bool">
                                                    @endif
                                                    <label for="{{ $software->sw_id }}" data-on-label="กำลังดำเนินการ"
                                                        data-off-label="ปิดโครงการ"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewSoftwareDetails({{ $software->sw_id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editSoftware({{ $software->sw_id }})"><i
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
                            @if (count($softwares))
                                {{ $softwares->links('livewire-pagination-links') }}
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
                        <h4 class="modal-title">เพิ่มข้อมูลโครงการ</h4>
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
                                                    <input type="text" id="name"
                                                        class="form-control form-control-light" wire:model.defer="name">
                                                    @error('name')
                                                        <span class="text-danger"
                                                            style="font-size: 11.5px">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">เจ้าของโครงการ</label>
                                                <select id="owner_id" class="form-select form-control-light"
                                                    wire:model.defer="owner_id">
                                                    <option value="">เลือกเจ้าของโครงการ</option>
                                                    @foreach ($owners as $os)
                                                        <option value="{{ $os->id }}"
                                                            wire:key="owner_id-{{ $os->id }}">
                                                            {{ $os->firstname }}
                                                            {{ $os->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณทั้งหมด</label>
                                                <input type="text" id="allBudget"
                                                    class="form-control form-control-light" wire:model.defer="allBudget">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณคาดหวัง</label>
                                                <input type="text" id="expectedBudget"
                                                    class="form-control form-control-light"
                                                    wire:model.defer="expectedBudget">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่ทำสัญญา</label>
                                                <input type="date" id="signDate"
                                                    class="form-control form-control-light" wire:model.defer="signDate">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่เริ่มโครงการ</label>
                                                <input type="date" id="startDate"
                                                    class="form-control form-control-light" wire:model.defer="startDate">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่สิ้นสุดโครงการ</label>
                                                <input type="date" id="endDate"
                                                    class="form-control form-control-light" wire:model.defer="endDate">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ระยะเวลา (เดือน)</label>
                                                <input type="text" id="duration"
                                                    class="form-control form-control-light" wire:model.defer="duration">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ผู้รับชอบโครงการ</label>
                                                <select id="sm_id" class="form-select form-control-light"
                                                    wire:model.defer="sm_id">
                                                    <option value="">เลือกผู้รับผิดชอบโครงการ</option>
                                                    @foreach ($sms as $us)
                                                        <option value="{{ $us->id }}"
                                                            wire:key="sm_id-{{ $us->id }}">
                                                            {{ $us->firstname }}
                                                            {{ $us->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>
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

                        {{-- @include('livewire.form-dropdown.p-e-r-t-dropdown') --}}
                        {{-- <livewire:form-dropdown.p-e-r-t-dropdown /> --}}

                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Modal -->

        <!-- Edit Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="editSoftware" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูล Software</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editSoftwareData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ชื่อโครงการ</label>
                                                <div>
                                                    <input type="text" id="name"
                                                        class="form-control form-control-light" wire:model.defer="name">
                                                    @error('name')
                                                        <span class="text-danger"
                                                            style="font-size: 11.5px">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">เจ้าของโครงการ</label>
                                                <select id="owner_id" class="form-select form-control-light"
                                                    wire:model.defer="owner_id">
                                                    <option value="">เลือกเจ้าของโครงการ</option>
                                                    @foreach ($owners as $os)
                                                        <option value="{{ $os->id }}"
                                                            wire:key="owner_id-{{ $os->id }}">
                                                            {{ $os->firstname }}
                                                            {{ $os->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณทั้งหมด</label>
                                                <input type="text" id="allBudget"
                                                    class="form-control form-control-light" wire:model.defer="allBudget">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">งบประมาณคาดหวัง</label>
                                                <input type="text" id="expectedBudget"
                                                    class="form-control form-control-light"
                                                    wire:model.defer="expectedBudget">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่ทำสัญญา</label>
                                                <input type="date" id="signDate"
                                                    class="form-control form-control-light" wire:model.defer="signDate">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่เริ่มโครงการ</label>
                                                <input type="date" id="startDate"
                                                    class="form-control form-control-light" wire:model.defer="startDate">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">วันที่สิ้นสุดโครงการ</label>
                                                <input type="date" id="endDate"
                                                    class="form-control form-control-light" wire:model.defer="endDate">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ระยะเวลา (เดือน)</label>
                                                <input type="text" id="duration"
                                                    class="form-control form-control-light" wire:model.defer="duration">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">ผู้รับชอบโครงการ</label>
                                                <select id="sm_id" class="form-select form-control-light"
                                                    wire:model.defer="sm_id">
                                                    <option value="">เลือกผู้รับผิดชอบโครงการ</option>
                                                    @foreach ($sms as $us)
                                                        <option value="{{ $us->id }}"
                                                            wire:key="sm_id-{{ $us->id }}">
                                                            {{ $us->firstname }}
                                                            {{ $us->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
        <div wire:ignore.self class="modal fade task-modal-content" id="viewSoftware" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูล Software</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewSoftwareModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>ชื่อโครงการ</th>
                                    <td>{{ $view_name }}</td>
                                </tr>


                                <tr>
                                    <th>เจ้าของโครงการ</th>
                                    <td>{{ $view_owner_name }}</td>
                                </tr>

                                <tr>
                                    <th>ผู้รับชอบโครงการ</th>
                                    <td>{{ $view_sm_name }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลา (เดือน)</th>
                                    <td>{{ $view_duration }}</td>
                                </tr>

                                <tr>
                                    <th>งบประมาณทั้งหมด</th>
                                    <td>{{ $view_allBudget }}</td>
                                </tr>

                                <tr>
                                    <th>งบประมาณคาดหวัง</th>
                                    <td>{{ $view_expectedBudget }}</td>
                                </tr>

                                <tr>
                                    <th>วันที่ทำสัญญา</th>
                                    <td>{{ $view_signDate }}</td>
                                </tr>

                                <tr>
                                    <th>วันที่เริ่มโครงการ</th>
                                    <td>{{ $view_startDate }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลาที่ช้าที่สุด</th>
                                    <td>{{ $view_endDate }}</td>
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
                    url: "{{ url('/api/updateStatusSoftware') }}",

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
