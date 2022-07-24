<div class="row">
    <div class="form-group col-md-11">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3" style="padding-top: 20px">
                    <label for="name" class="form-label">ชื่อโครงการ</label>
                    <select id="input_sw" class="form-select form-control-light" wire:model="sw_id">
                        <option value="">เลือกโครงการ</option>
                        {{-- @foreach ($softwares as $sw)
                            <option value="{{ $sw->id }}" wire:key="sw_id-{{ $sw->id }}">{{ $sw->name }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3" style="padding-top: 20px">
                    <label for="task-title" class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>
                    <input type="text" id="input_company" disabled class="form-control form-control-light"
                        wire:model="input_company">
                </div>
            </div>
        </div>

        <hr style="border: 1px solid rgb(37, 37, 37); color: rgb(37, 37, 37);">

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">{{ session('message') }}</div>
                    @endif
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="text-align: center">รหัส</th>
                                <th style="text-align: center">ชื่องาน</th>
                                <th style="text-align: center">ผู้รับผิดชอบ</th>
                                <th style="text-align: center">วันที่มอบหมายงาน</th>
                                <th style="text-align: center">ระยะเวลาที่ใช้</th>
                                <th style="text-align: center">วันที่ส่งงาน</th>
                                <th style="text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if ($US->count() > 0) --}}
                                {{-- @foreach ($US as $row) --}}
                                    <tr>
                                        <td style="text-align: center">T01</td>
                                        <td style="text-align: center">Design</td>
                                        <td style="text-align: center">yu</td>
                                        <td style="text-align: center">02/04/2565</td>
                                        <td style="text-align: center">6</td>
                                        <td style="text-align: center">08/04/2565</td>
                                        <td style="text-align: center">
                                            <div class="badge bg-success mb-3">ปกติ</div>
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
                            {{-- @else --}}
                                {{-- <tr>
                                    <td colspan="4" style="text-align: center">
                                        <small>ยังไม่มีข้อมูลขณะนี้</small>
                                    </td>
                                </tr>
                            @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        // showCompa
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
@endpush
