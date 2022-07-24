<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูลคำนำหน้าชื่อ</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลคำนำหน้าชื่อ
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addNameTitle"
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
                                        <th style="text-align: center">รหัสคำนำหน้าชื่อ</th>
                                        <th style="text-align: center">คำนำหน้าชื่อ</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($nametitles->count() > 0)
                                        @foreach ($nametitles as $nametitle)
                                            <tr>
                                                <td style="text-align: center">{{ $nametitle->id }}</td>
                                                <td style="text-align: center">{{ $nametitle->name }}</td>

                                                <td style="text-align: center">
                                                    @if ($nametitle->status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $nametitle->id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $nametitle->id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $nametitle->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewNameTitleDetails({{ $nametitle->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editNameTitle({{ $nametitle->id }})"><i
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
                            @if (count($nametitles))
                                {{ $nametitles->links('livewire-pagination-links') }}
                            @endif
                            {{-- {!! $nametitles->appends(Request::all())->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addNameTitle" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูลคำนำหน้าชื่อ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeNameTitleData">
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
        {{-- <div wire:ignore.self class="modal fade" id="deleteNameTitle" tabindex="-1" role="dialog"
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
        </div> --}}
        <!-- End Delete Modal -->

        <!-- View Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="viewNameTitle" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูลคำนำหน้าชื่อ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeViewNameTitleModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $view_nametitle_id }}</td>
                                </tr>

                                <tr>
                                    <th>คำนำหน้าชื่อ</th>
                                    <td>{{ $view_nametitle }}</td>
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
            $('#addNameTitle').modal('hide');
            $('#editNameTitle').modal('hide');
            // $('#deleteNameTitle').modal('hide');
            $('#viewNameTitle').modal('hide');
        });

        window.addEventListener('show-edit-nametitle-modal', event => {
            $('#editNameTitle').modal('show');
        });

        // window.addEventListener('show-delete-nametitle-modal', event => {
        //     $('#deleteNameTitle').modal('show');
        // });

        window.addEventListener('show-view-nametitle-modal', event => {
            $('#viewNameTitle').modal('show');
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
                    url: "{{ url('/api/updateStatusNameTitle') }}",

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
