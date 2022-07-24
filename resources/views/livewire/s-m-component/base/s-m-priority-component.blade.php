<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูล Priority</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูล Priority
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addPriority"
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
                                        <th style="text-align: center">รหัส Priority</th>
                                        <th style="text-align: center">Priority</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($prioritys->count() > 0)
                                        @foreach ($prioritys as $priority)
                                            <tr>
                                                <td style="text-align: center">{{ $priority->id }}</td>
                                                <td style="text-align: center">{{ $priority->name }}</td>

                                                <td style="text-align: center">
                                                    @if ($priority->status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $priority->id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $priority->id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $priority->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewPriorityDetails({{ $priority->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editPriority({{ $priority->id }})"><i
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
                            @if (count($prioritys))
                                {{ $prioritys->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addPriority" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูล Priority</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storepriorityData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Priority</label>
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
        <div wire:ignore.self class="modal fade task-modal-content" id="editPriority" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูล Priority</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editPriorityData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Priority</label>
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
        <div wire:ignore.self class="modal fade task-modal-content" id="viewPriority" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูล Priority</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewPriorityModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>รหัส</th>
                                    <td>{{ $view_priority_id }}</td>
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
            $('#addPriority').modal('hide');
            $('#editPriority').modal('hide');
            $('#viewPriority').modal('hide');
        });

        window.addEventListener('show-edit-priority-modal', event => {
            $('#editPriority').modal('show');
        });

        window.addEventListener('show-view-priority-modal', event => {
            $('#viewPriority').modal('show');
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
                    url: "{{ url('/api/updateStatusPriority') }}",

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
