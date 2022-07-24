<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">การจัดการงานในโครงการ</a></li>
                        <li class="breadcrumb-item active">ข้อมูล User Story</li>
                    </ol>
                </div>
                <h4 class="page-title">ข้อมูล User Story
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
                            <table class="table md-0">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: left">
                                            <label for="name" class="form-label">ชื่อโครงการ</label>
                                        </th>
                                        <th scope="col" style="text-align: center">
                                            <select id="sw_id" class="form-select form-control-light"
                                                wire:model="sw_id">
                                                <option value="" disabled>เลือกโครงการ</option>
                                                {{-- @foreach ($softwares as $sw)
                                                    <option value="{{ $sw->id }}"
                                                        wire:key="sw_id-{{ $sw->id }}">{{ $sw->name }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                        <table class="table md-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">
                                        <h4>User Story ทั้งหมด</h4>
                                    </th>
                                    <th scope="col" style="text-align: center">
                                        <h4>Product Backlog</h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="row" style="background-color: rgb(220, 229, 245)">
                                        {{-- <div class="cards" style="background-color: rgb(220, 229, 245)">
                                            <div class="us_color"> --}}
                                        @if (session()->has('message'))
                                            <div class="alert alert-success text-center">
                                                {{ session('message') }}</div>
                                        @endif
                                        <table class="table table-bordered md-0" style="background-color: white">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">User Story</th>
                                                    <th style="text-align: center">ระยะเวลา</th>
                                                    <th style="text-align: center">Priority</th>
                                                    <th style="text-align: center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($US->count() > 0)
                                                    @foreach ($US as $row)
                                                        <tr>
                                                            <td>{{ $row->us_name }}</td>
                                                            <td style="text-align: center">
                                                                {{ $row->us_duration }}</td>
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
                                                                <button class="btn btn-sm btn-primary my-1"
                                                                    wire:click="viewPERTDetails({{ $row->id }})"><i
                                                                        class="mdi mdi-file-search-outline"></i></button>
                                                                <button class="btn btn-sm btn-secondary"
                                                                    wire:click="editPERT({{ $row->id }})"><i
                                                                        class="mdi mdi-arrow-right-bold"></i></button>
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
                                        {{-- @if (count($US))
                                                        {{ $US->links('livewire-pagination-links') }}
                                                    @endif --}}
                                        {{-- </div>
                                        </div> --}}
                                    </th>
                                    <th scope="row" style="background-color: rgb(220, 229, 245)">
                                        {{-- <div class="cards" style="background-color: rgb(220, 229, 245)">
                                            <div class="us_color"> --}}
                                        @if (session()->has('message'))
                                            <div class="alert alert-success text-center">
                                                {{ session('message') }}</div>
                                        @endif
                                        <table class="table table-bordered md-0" style="background-color: white">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">ลำดับ</th>
                                                    <th style="text-align: center">User Story</th>
                                                    <th style="text-align: center">ระยะเวลา</th>
                                                    <th style="text-align: center">Priority</th>
                                                    <th style="text-align: center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($US->count() > 0)
                                                    @foreach ($US as $row)
                                                        <tr>
                                                            <td style="text-align: center">{{ ++$i }}</td>
                                                            <td>{{ $row->us_name }}</td>
                                                            <td style="text-align: center">
                                                                {{ $row->us_duration }}</td>
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
                                                                <button class="btn btn-sm btn-primary my-1"
                                                                    wire:click="viewPERTDetails({{ $row->id }})"><i
                                                                        class="mdi mdi-file-search-outline"></i></button>
                                                                <button class="btn btn-sm btn-secondary"
                                                                    wire:click="editPERT({{ $row->id }})"><i
                                                                        class="mdi mdi-arrow-left-bold"></i></button>
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
                                        {{-- @if (count($US))
                                                        {{ $US->links('livewire-pagination-links') }}
                                                    @endif --}}
                                        {{-- </div>
                                        </div> --}}
                                    </th>
                                </tr>

                            </thead>

                        </table>
                        {{-- @if (count($users))
                                {{ $users->links('livewire-pagination-links') }}
                            @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


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
