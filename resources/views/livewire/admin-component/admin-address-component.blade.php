<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูลตำบล อำเภอ จังหวัด</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลตำบล อำเภอ จังหวัด
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addAddress"
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
                                        <th style="text-align: center">จังหวัด</th>
                                        <th style="text-align: center">อำเภอ</th>
                                        <th style="text-align: center">ตำบล</th>
                                        <th style="text-align: center">รหัสไปรษณีย์</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($addresses->count() > 0)
                                        @foreach ($addresses as $address)
                                            <tr>
                                                <td style="text-align: center">{{ ++$i }}</td>
                                                <td style="text-align: center">{{ $address->province_name }}</td>
                                                <td style="text-align: center">{{ $address->amphure_name }}</td>
                                                <td style="text-align: center">{{ $address->district_name }}</td>
                                                <td style="text-align: center">{{ $address->zip_code }}</td>

                                                <td style="text-align: center">
                                                    @if ($address->status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $address->id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $address->id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $address->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewNameTitleDetails({{ $address->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editNameTitle({{ $address->id }})"><i
                                                            class="mdi mdi-pencil"></i></button>
                                                    {{-- <button class="btn btn-sm btn-danger" wire:click="deleteNameTitle({{ $nametitle->id }})">Delete</button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center"><small>ยังไม่มีข้อมูลขณะนี้</small></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if (count($addresses))
                                {{ $addresses->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="editNameTitle" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูลคำนำหน้าชื่อ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editNameTitleData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">คำนำหน้าชื่อ</label>
                                        <div>
                                            <input type="text" id="name" class="form-control form-control-light"
                                                wire:model="name">
                                            @error('name')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
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

        <!-- Delete Modal -->
        <div wire:ignore.self class="modal fade" id="deleteNameTitle" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ลบข้อมูลคำนำหน้าชื่อ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4 pb-4">
                        <h6>ต้องการลบข้อมูลคำนำหน้าชื่อใช่หรือไม่</h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal"
                            aria-label="Close">ยกเลิก</button>
                        <button class="btn btn-sm btn-danger" wire:click="deleteNameTitleData()">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Modal -->

        <!-- View Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="viewAddress" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูลตำบล อำเภอ จังหวัด</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewAddressModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>รหัส</th>
                                    <td>{{ $view_address_id }}</td>
                                </tr>

                                <tr>
                                    <th>จังหวัด</th>
                                    <td>{{ $view_province_name }}</td>
                                </tr>

                                <tr>
                                    <th>อำเภอ</th>
                                    <td>{{ $view_province_name }}</td>
                                </tr>

                                <tr>
                                    <th>ตำบล</th>
                                    <td>{{ $view_province_name }}</td>
                                </tr>

                                <tr>
                                    <th>รหัสไปรษณีย์</th>
                                    <td>{{ $view_province_name }}</td>
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
            $('#editNameTitle').modal('hide');
            $('#viewAddress').modal('hide');
        });

        window.addEventListener('show-edit-nametitle-modal', event => {
            $('#editNameTitle').modal('show');
        });

        window.addEventListener('show-view-nametitle-modal', event => {
            $('#viewAddress').modal('show');
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

                $.ajax({
                    url: "{{ url('/api/updateStatusAddress') }}",

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
