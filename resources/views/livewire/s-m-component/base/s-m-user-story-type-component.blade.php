<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูลประเภทของกิจกรรม</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูลประเภทของกิจกรรม
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addUserStoryType"
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
                                        <th style="text-align: center">ชื่อประเภทของกิจกรรม</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userstorytypes->count() > 0)
                                        @foreach ($userstorytypes as $userstorytype)
                                            <tr>
                                                <td style="text-align: center">{{ $userstorytype->id }}</td>
                                                <td style="text-align: center">{{ $userstorytype->name }}</td>

                                                <td style="text-align: center">
                                                    @if ($userstorytype->status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $userstorytype->id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $userstorytype->id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $userstorytype->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewUserStoryTypeDetails({{ $userstorytype->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editUserStoryType({{ $userstorytype->id }})"><i
                                                            class="mdi mdi-pencil"></i></button>
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
                            @if (count($userstorytypes))
                                {{ $userstorytypes->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addUserStoryType" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูลประเภทของกิจกรรม</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeuserstorytypeData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ชื่อประเภทของกิจกรรม</label>
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
        <div wire:ignore.self class="modal fade task-modal-content" id="editUserStoryType" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูลประเภทของกิจกรรม</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editUserStoryTypeData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ชื่อประเภทของกิจกรรม</label>
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

        <!-- View Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="viewUserStoryType" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูลประเภทของกิจกรรม</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewUserStoryTypeModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>รหัส</th>
                                    <td>{{ $view_userstorytype_id }}</td>
                                </tr>

                                <tr>
                                    <th>ชื่อประเภทของกิจกรรม</th>
                                    <td>{{ $view_userstorytype }}</td>
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
            $('#addUserStoryType').modal('hide');
            $('#editUserStoryType').modal('hide');
            $('#viewUserStoryType').modal('hide');
        });

        window.addEventListener('show-edit-userstorytype-modal', event => {
            $('#editUserStoryType').modal('show');
        });

        window.addEventListener('show-view-userstorytype-modal', event => {
            $('#viewUserStoryType').modal('show');
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
                    url: "{{ url('/api/updateStatusUserStoryType') }}",

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
