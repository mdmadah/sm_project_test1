<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการข้อมูลพื้นฐาน</a></li>
                        <li class="breadcrumb-item active">ข้อมูล PERT</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูล PERT
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addPERT"
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
                                        <th style="text-align: center">ประเภทกิจกรรม</th>
                                        <th style="text-align: center">ระยะเวลาที่เร็วที่สุด</th>
                                        <th style="text-align: center">ระยะเวลาปกติ</th>
                                        <th style="text-align: center">ระยะเวลาที่ช้าที่สุด</th>
                                        <th style="text-align: center">สถานะการใช้งาน</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($perts->count() > 0)
                                        @foreach ($perts as $pert)
                                            <tr>
                                                <td style="text-align: center">{{ $pert->id }}</td>
                                                <td style="text-align: center">{{ $pert->at_name }}</td>
                                                <td style="text-align: center">{{ $pert->ET }}</td>
                                                <td style="text-align: center">{{ $pert->NT }}</td>
                                                <td style="text-align: center">{{ $pert->LT }}</td>

                                                <td style="text-align: center">
                                                    @if ($pert->status == 0)
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $pert->id }}" checked data-switch="bool">
                                                    @else
                                                        <input type="checkbox" class="switch"
                                                            id="{{ $pert->id }}" data-switch="bool">
                                                    @endif
                                                    <label for="{{ $pert->id }}" data-on-label="On"
                                                        data-off-label="Off"></label>
                                                </td>

                                                <td style="text-align: center">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="viewPERTDetails({{ $pert->id }})"><i
                                                            class="mdi mdi-file-search-outline"></i></button>
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click="editPERT({{ $pert->id }})"><i
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
                            @if (count($perts))
                                {{ $perts->links('livewire-pagination-links') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div wire:ignore.self class="modal fade task-modal-content" id="addPERT" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มข้อมูล PERT</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storepertData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">ประเภทกิจกรรม</label>
                                        <div>
                                            <select id="at_id" class="form-select form-control-light" wire:model="at_id">
                                                <option value="">เลือกประเภทกิจกรรม</option>
                                                @foreach ($act_type as $a)
                                                    <option value="{{ $a->id }}"
                                                        wire:key="at_id-{{ $a->id }}">{{ $a->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('at_id')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาที่เร็วที่สุด (วัน)</label>
                                        <input type="text" id="ET" class="form-control form-control-light" wire:model="ET">
                                        @error('ET')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาปกติ (วัน)</label>
                                        <input type="text" id="NT" class="form-control form-control-light" wire:model="NT">
                                        @error('NT')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาที่ช้าที่สุด (วัน)</label>
                                        <input type="text" id="LT" class="form-control form-control-light" wire:model="LT">
                                        @error('LT')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
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
        <div wire:ignore.self class="modal fade task-modal-content" id="editPERT" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูล PERT</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="editPERTData">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">ประเภทกิจกรรม</label>
                                        <div>
                                            <select id="at_id" class="form-select form-control-light" wire:model="at_id">
                                                <option value="">เลือกประเภทกิจกรรม</option>
                                                @foreach ($act_type as $a)
                                                    <option value="{{ $a->id }}"
                                                        wire:key="at_id-{{ $a->id }}">{{ $a->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('at_id')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาที่เร็วที่สุด (วัน)</label>
                                        <input type="text" id="ET" class="form-control form-control-light" wire:model="ET">
                                        @error('ET')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาปกติ (วัน)</label>
                                        <input type="text" id="NT" class="form-control form-control-light" wire:model="NT">
                                        @error('NT')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="task-title" class="form-label">ระยะเวลาที่ช้าที่สุด (วัน)</label>
                                        <input type="text" id="LT" class="form-control form-control-light" wire:model="LT">
                                        @error('LT')
                                                <span class="text-danger"
                                                    style="font-size: 11.5px">{{ $message }}</span>
                                            @enderror
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
        <div wire:ignore.self class="modal fade task-modal-content" id="viewPERT" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อมูล PERT</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeviewPERTModal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <th>ชื่อประเภทของกิจกรรม</th>
                                    <td>{{ $view_at_name }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลาที่เร็วที่สุด</th>
                                    <td>{{ $view_ET }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลาปกติ</th>
                                    <td>{{ $view_NT }}</td>
                                </tr>

                                <tr>
                                    <th>ระยะเวลาที่ช้าที่สุด</th>
                                    <td>{{ $view_LT }}</td>
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
            $('#addPERT').modal('hide');
            $('#editPERT').modal('hide');
            $('#viewPERT').modal('hide');
        });

        window.addEventListener('show-edit-pert-modal', event => {
            $('#editPERT').modal('show');
        });

        window.addEventListener('show-view-pert-modal', event => {
            $('#viewPERT').modal('show');
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
@endpush
