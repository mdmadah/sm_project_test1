<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลผู้ใช้งาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูลผู้ใช้งานภายในองค์กร</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลผู้ใช้งานภายในองค์กร
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addOwnerUser"
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
                                                        wire:click="viewOwnerUserDetails({{ $row->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editOwnerUser({{ $row->id }})"><i
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
        <div wire:ignore.self class="modal fade task-modal-content" id="addOwnerUser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูลผู้ใช้งานภายในองค์กร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeOwnerUserData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">คำนำหน้าชื่อ</label>
                                                <select id="nametitle" class="form-select form-control-light"
                                                    wire:model="nametitle">
                                                    <option value="" disabled>เลือกคำนำหน้าชื่อ</option>
                                                    @foreach ($nametitle as $nt)
                                                        <option value="{{ $nt->id }}"
                                                            wire:key="nametitle-{{ $nt->id }}">
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
                                                    id="firstname" wire:model="firstname">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">นามสกุล</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="lastname" wire:model="lastname">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="phone" wire:model="phone">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Facebook</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="facebook" wire:model="facebook">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Line ID</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="lineID" wire:model="lineID">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-town-city" class="form-label">บ้านเลขที่</label>
                                                <input name="no" id="form-no"
                                                    class="form-control form-control-light" wire:model="form-no">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-state" class="form-label">หมู่ที่</label>
                                                <input name="mu" id="form-mu"
                                                    class="form-control form-control-light" wire:model="form-mu">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-street" class="form-label">ถนน</label>
                                                <input name="street" id="form-street"
                                                    class="form-control form-control-light" wire:model="form-street">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">จังหวัด</label>
                                                <select id="input_province" class="form-select form-control-light"
                                                    wire:model="input_province">
                                                    <option value="">กรุณาเลือกจังหวัด</option>
                                                    {{-- @foreach ($provinces as $item)
                                                        <option value="{{ $item->province }}"
                                                            wire:key="province-{{ $item->province }}">
                                                            {{ $item->province }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="billing-address" class="form-label">อำเภอ</label>
                                                <select id="input_amphoe" class="form-select form-control-light"
                                                    wire:model="input_amphoe">
                                                    <option value="">กรุณาเลือกเขต/อำเภอ</option>
                                                    {{-- @foreach ($amphoes as $item)
                                                        <option value="{{ $item->amphoe }}"
                                                            wire:key="province-{{ $item->amphoe }}">
                                                            {{ $item->amphoe }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="billing-address" class="form-label">ตำบล</label>
                                                <select id="input_tambon" class="form-select form-control-light"
                                                    wire:model="input_amphoe">
                                                    <option value="">กรุณาเลือกแขวง/ตำบล</option>
                                                    {{-- @foreach ($tambons as $item)
                                                        <option value="{{ $item->tambon }}"
                                                            wire:key="province-{{ $item->tambon }}">
                                                            {{ $item->tambon }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">รหัสไปรษณีย์</label>
                                                <input name="postcode" id="input_zipcode" class="form-control">
                                                {{-- disabled
                                                type="text" value="{{ $compa->postcode }}"
                                                wire:model="input_zipcode"> --}}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">อีเมล</label>
                                                <input name="email" id="form-email"
                                                    class="form-control form-control-light" wire:model="form-email">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Password</label>
                                                <input name="password" id="form-password"
                                                    class="form-control form-control-light"
                                                    wire:model="form-Password">
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
        <div wire:ignore.self class="modal fade task-modal-content" id="editOwnerUser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูลคำนำหน้าชื่อ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editOwnerUserData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">คำนำหน้าชื่อ</label>
                                                <select id="nametitle" class="form-select form-control-light"
                                                    wire:model="nametitle">
                                                    <option value="" disabled>เลือกคำนำหน้าชื่อ</option>
                                                    @foreach ($nametitle as $nt)
                                                        <option value="{{ $nt->id }}"
                                                            wire:key="nametitle-{{ $nt->id }}">
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
                                                    id="firstname" wire:model="firstname">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">นามสกุล</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="lastname" wire:model="lastname">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="phone" wire:model="phone">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Facebook</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="facebook" wire:model="facebook">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Line ID</label>
                                                <input type="text" class="form-control form-control-light"
                                                    id="lineID" wire:model="lineID">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-town-city" class="form-label">บ้านเลขที่</label>
                                                <input name="no" id="form-no"
                                                    class="form-control form-control-light" wire:model="form-no">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-state" class="form-label">หมู่ที่</label>
                                                <input name="mu" id="form-mu"
                                                    class="form-control form-control-light" wire:model="form-mu">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="billing-street" class="form-label">ถนน</label>
                                                <input name="street" id="form-street"
                                                    class="form-control form-control-light" wire:model="form-street">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">จังหวัด</label>
                                                <select id="input_province" class="form-select form-control-light"
                                                    wire:model="input_province">
                                                    <option value="">กรุณาเลือกจังหวัด</option>
                                                    {{-- @foreach ($provinces as $item)
                                                        <option value="{{ $item->province }}"
                                                            wire:key="province-{{ $item->province }}">
                                                            {{ $item->province }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="billing-address" class="form-label">อำเภอ</label>
                                                <select id="input_amphoe" class="form-select form-control-light"
                                                    wire:model="input_amphoe">
                                                    <option value="">กรุณาเลือกเขต/อำเภอ</option>
                                                    {{-- @foreach ($amphoes as $item)
                                                        <option value="{{ $item->amphoe }}"
                                                            wire:key="province-{{ $item->amphoe }}">
                                                            {{ $item->amphoe }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="billing-address" class="form-label">ตำบล</label>
                                                <select id="input_tambon" class="form-select form-control-light"
                                                    wire:model="input_amphoe">
                                                    <option value="">กรุณาเลือกแขวง/ตำบล</option>
                                                    {{-- @foreach ($tambons as $item)
                                                        <option value="{{ $item->tambon }}"
                                                            wire:key="province-{{ $item->tambon }}">
                                                            {{ $item->tambon }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">รหัสไปรษณีย์</label>
                                                <input name="postcode" id="input_zipcode" class="form-control">
                                                {{-- disabled
                                                type="text" value="{{ $compa->postcode }}"
                                                wire:model="input_zipcode"> --}}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">อีเมล</label>
                                                <input name="email" id="form-email"
                                                    class="form-control form-control-light" wire:model="form-email">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="task-title" class="form-label">Password</label>
                                                <input name="password" id="form-password"
                                                    class="form-control form-control-light"
                                                    wire:model="form-Password">
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
        {{-- <div wire:ignore.self class="modal fade task-modal-content" id="viewOwnerUser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูลคำนำหน้าชื่อ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeViewOwnerUserModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>รหัส</th>
                                    <td>{{ $view_nametitle_id }}</td>
                                </tr>

                                <tr>
                                    <th>ชื่อองค์กร</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                                <tr>
                                    <th>ชื่อ-นามสกุลตัวแทนองค์กร</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                                <tr>
                                    <th>อีเมลองค์กร</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                                <tr>
                                    <th>เบอร์โทรศัพท์</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                                <tr>
                                    <th>เบอร์โทรตัวแทนองค์กร</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                                <tr>
                                    <th>ที่อยู่องค์กร</th>
                                    <td>{{ $view_nametitle }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- End View Modal -->

    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addOwnerUser').modal('hide');
            $('#editOwnerUser').modal('hide');
            // $('#deleteOwnerUser').modal('hide');
            $('#viewOwnerUser').modal('hide');
        });

        window.addEventListener('show-edit-nametitle-modal', event => {
            $('#editOwnerUser').modal('show');
        });

        // window.addEventListener('show-delete-nametitle-modal', event => {
        //     $('#deleteOwnerUser').modal('show');
        // });

        window.addEventListener('show-view-nametitle-modal', event => {
            $('#viewOwnerUser').modal('show');
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
                // console.log("{{ url('/api/updateOwnerUser') }}");

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
