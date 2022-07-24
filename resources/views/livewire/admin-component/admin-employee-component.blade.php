<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box px-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลผู้ใช้งาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูลผู้ใช้งานภายในองค์กร</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลผู้ใช้งานภายในองค์กร
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addEmployeeUser"
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
                                        <th style="text-align: center">ชื่อ-นามสกุล</th>
                                        <th style="text-align: center">ตำแหน่งงาน</th>
                                        <th style="text-align: center">เบอร์โทรศัพท์</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count() > 0)
                                        @foreach ($users as $row)
                                            <tr>
                                                <td style="text-align: center">{{ ++$i }}</td>
                                                <td style="text-align: center">{{ $row->firstname }}
                                                    {{ $row->lastname }}</td>
                                                <td style="text-align: center">{{ $row->position }}</td>
                                                <td style="text-align: center">{{ $row->phone }}</td>
                                                <td style="text-align: center">
                                                    @if ($row->status == 0)
                                                        <input type="checkbox" class="switch" id="{{ $row->id }}"
                                                            checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch" id="{{ $row->id }}"
                                                            data-switch="bool">
                                                    @endif
                                                    <label for="{{ $row->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewEmployeeUserDetails({{ $row->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editEmployeeUser({{ $row->id }})"><i
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
                            @if (count($users))
                                {{ $users->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addEmployeeUser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูลผู้ใช้งานภายในองค์กร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeEmployeeUserModal"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeEmployeeUserData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-11">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">คำนำหน้าชื่อ</label>
                                                <select id="nametitled" class="form-select form-control-light"
                                                    wire:model="nametitle">
                                                    <option value="" selected>เลือกคำนำหน้าชื่อ</option>
                                                    @foreach ($nametitles as $nt)
                                                        <option value="{{ $nt->id }}">
                                                            {{ $nt->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ชื่อ</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="name_en" wire:model="f_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">นามสกุล</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="name_en" wire:model="l_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ตำแหน่งงาน</label>
                                                <select id="position" class="form-select form-control-light"
                                                    wire:model="position">
                                                    <option value="" selected>เลือกตำแหน่งงาน</option>
                                                    @foreach ($positions as $p)
                                                        <option value="{{ $p->id }}">
                                                            {{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="f_name" wire:model="phone">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Facebook</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="l_name" wire:model="facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="billing-phone" class="form-label">Line ID</label>
                                                <input name="line" id="form-phone"
                                                    class="form-control form-control-light" wire:model="line">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-town-city" class="form-label">บ้านเลขที่</label>
                                                <input name="no" id="form-no"
                                                    class="form-control form-control-light" wire:model="no">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-state" class="form-label">หมู่ที่</label>
                                                <input name="mu" id="form-mu"
                                                    class="form-control form-control-light" wire:model="mu">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-street" class="form-label">ถนน</label>
                                                <input name="street" id="form-street"
                                                    class="form-control form-control-light" wire:model="street">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">รหัสไปรษณีย์</label>
                                                <input id="selectedZipcode" placeholder="กรุณาเลือกจังหวัด"
                                                    class="form-control form-control-light" wire:model="zipcode"
                                                    value="{{ $zipcode }}">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">จังหวัด</label>
                                                <select id="selectedProvinces" class="form-select form-control-light"
                                                    wire:model="selectedProvince">
                                                    <option value="" selected>กรุณาเลือกจังหวัด</option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item['province'] }}">
                                                            {{ $item['province'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @if (!is_null($selectedProvince))

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="billing-address" class="form-label">อำเภอ</label>
                                                    <select id="selectedAmphoe" class="form-select form-control-light"
                                                        wire:model="selectedAmphoe">
                                                        <option value="">กรุณาเลือกเขต/อำเภอ</option>
                                                        @foreach ($amphoes as $item)
                                                            <option value="{{ $item['amphoe'] }}">
                                                                {{ $item['amphoe'] }}
                                                            </option>
                                                        @endforeach
                                                        >
                                                    </select>
                                                </div>

                                            </div>
                                        @endif

                                        @if (!is_null($selectedAmphoe))

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="billing-address" class="form-label">ตำบล</label>
                                                    <select id="selectedTambon" class="form-select form-control-light"
                                                        wire:model="selectedTambon">
                                                        <option value="">กรุณาเลือกแขวง/ตำบล</option>
                                                        @foreach ($tambons as $item)
                                                            <option value="{{ $item['tambon'] }}">
                                                                {{ $item['tambon'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">อีเมล</label>
                                                <input name="email" id="form-email"
                                                    class="form-control form-control-light" wire:model="email">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Password</label>
                                                <input name="password" id="form-password" type="password"
                                                    class="form-control form-control-light" wire:model="password">
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
        <div wire:ignore.self class="modal fade task-modal-content" id="editEmployeeUser" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูลผู้ใช้งานภายในองค์กร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeEmployeeUserModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editEmployeeUserData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-11">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">คำนำหน้าชื่อ</label>
                                                <select id="nametitled" class="form-select form-control-light"
                                                    wire:model="nametitle">
                                                    <option value="" selected>เลือกคำนำหน้าชื่อ</option>
                                                    @foreach ($nametitles as $nt)
                                                        <option value="{{ $nt->id }}">
                                                            {{ $nt->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ชื่อ</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="name_en" wire:model="f_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">นามสกุล</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="name_en" wire:model="l_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">ตำแหน่งงาน</label>
                                                <select id="position" class="form-select form-control-light"
                                                    wire:model="position">
                                                    <option value="" selected>เลือกตำแหน่งงาน</option>
                                                    @foreach ($positions as $p)
                                                        <option value="{{ $p->id }}">
                                                            {{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="f_name" wire:model="phone">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Facebook</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="l_name" wire:model="facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="billing-phone" class="form-label">Line ID</label>
                                                <input name="line" id="form-phone"
                                                    class="form-control form-control-light" wire:model="line">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-town-city" class="form-label">บ้านเลขที่</label>
                                                <input name="no" id="form-no"
                                                    class="form-control form-control-light" wire:model="no">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-state" class="form-label">หมู่ที่</label>
                                                <input name="mu" id="form-mu"
                                                    class="form-control form-control-light" wire:model="mu">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="billing-street" class="form-label">ถนน</label>
                                                <input name="street" id="form-street"
                                                    class="form-control form-control-light" wire:model="street">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">รหัสไปรษณีย์</label>
                                                <input id="selectedZipcode" placeholder="กรุณาเลือกจังหวัด"
                                                    class="form-control form-control-light" wire:model="zipcode"
                                                    value="{{ $zipcode }}">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">จังหวัด</label>
                                                <select id="selectedProvinces" class="form-select form-control-light"
                                                    wire:model="selectedProvince">
                                                    <option value="" selected>กรุณาเลือกจังหวัด</option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item['province'] }}">
                                                            {{ $item['province'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @if (!is_null($selectedProvince))

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="billing-address" class="form-label">อำเภอ</label>
                                                    <select id="selectedAmphoe" class="form-select form-control-light"
                                                        wire:model="selectedAmphoe">
                                                        <option value="">กรุณาเลือกเขต/อำเภอ</option>
                                                        @foreach ($amphoes as $item)
                                                            <option value="{{ $item['amphoe'] }}">
                                                                {{ $item['amphoe'] }}
                                                            </option>
                                                        @endforeach
                                                        >
                                                    </select>
                                                </div>

                                            </div>
                                        @endif

                                        @if (!is_null($selectedAmphoe))

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="billing-address" class="form-label">ตำบล</label>
                                                    <select id="selectedTambon" class="form-select form-control-light"
                                                        wire:model="selectedTambon">
                                                        <option value="">กรุณาเลือกแขวง/ตำบล</option>
                                                        @foreach ($tambons as $item)
                                                            <option value="{{ $item['tambon'] }}">
                                                                {{ $item['tambon'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif


                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">อีเมล</label>
                                                <input name="email" id="form-email"
                                                    class="form-control form-control-light" wire:model="email">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Password</label>
                                                <input name="password" id="form-password" type="password"
                                                    class="form-control form-control-light"
                                                    wire:model="password">
                                            </div>
                                        </div> --}}
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
        <div wire:ignore.self class="modal fade task-modal-content" id="viewEmployeeUser" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูลผู้ใช้งานภายในองค์กร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeEmployeeUserModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>ชื่อ-นามสกุล</th>
                                    <td>{{ $view_user_name }}</td>
                                </tr>

                                <tr>
                                    <th>ตำแหน่งงาน</th>
                                    <td>{{ $view_position }}</td>
                                </tr>
                                <tr>
                                    <th>Facebook</th>
                                    <td>{{ $view_facebook }}</td>
                                </tr>

                                <tr>
                                    <th>Line ID</th>
                                    <td>{{ $view_line }}</td>
                                </tr>
                                <tr>
                                    <th>เบอร์โทรศัพท์</th>
                                    <td>{{ $view_phone }}</td>
                                </tr>

                                <tr>
                                    <th>อีเมล</th>
                                    <td>{{ $view_email }}</td>
                                </tr>

                                <tr>
                                    <th>ที่อยู่</th>
                                    <td><b>บ้านเลขที่ </b>{{ $view_no }} <b>หมู่ที่ </b>{{ $view_mu }}
                                        <b>ถนน </b>{{ $view_street }}
                                        <b>ตำบล </b>{{ $view_tambon }} <b>อำเภอ </b>{{ $view_amphoe }}
                                        <b>จังหวัด </b>{{ $view_province }} {{ $view_zipcode }}
                                    </td>
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
            $('#addEmployeeUser').modal('hide');
            $('#editEmployeeUser').modal('hide');
            $('#viewEmployeeUser').modal('hide');
        });

        window.addEventListener('show-edit-nametitle-modal', event => {
            $('#editEmployeeUser').modal('show');
        });

        window.addEventListener('show-view-nametitle-modal', event => {
            $('#viewEmployeeUser').modal('show');
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
                // console.log("{{ url('/api/updateEmployeeUser') }}");

                $.ajax({
                    url: "{{ url('/api/updateStatusOwner') }}",

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
