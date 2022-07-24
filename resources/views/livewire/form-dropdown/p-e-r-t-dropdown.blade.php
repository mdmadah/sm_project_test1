<form wire:submit.prevent="storepertData">
    @csrf
    <div class="row">
        <div class="form-group col-md-8">

            <div class="mb-3">
                <label for="name" class="form-label">ประเภทกิจกรรม</label>
                <select id="at_id" class="form-select form-control-light" wire:model="at_id">
                    @foreach ($act_type as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}
                        </option>
                    @endforeach
                </select>
            </div>
{{-- {{ $act_type }} --}}
            <div class="mb-3">
                <label for="task-title" class="form-label">ระยะเวลาที่เร็วที่สุด
                    (วัน)</label>
                <input type="text" id="ET" class="form-control form-control-light" wire:model="ET">
            </div>

            <div class="mb-3">
                <label for="task-title" class="form-label">ระยะเวลาปกติ
                    (วัน)</label>
                <input type="text" id="NT" class="form-control form-control-light" wire:model="NT">
            </div>

            <div class="mb-3">
                <label for="task-title" class="form-label">ระยะเวลาที่ช้าที่สุด
                    (วัน)</label>
                <input type="text" id="LT" class="form-control form-control-light" wire:model="LT">
            </div>

        </div>
    </div>
    <livewire:form-dropdown.p-e-r-t-dropdown />

    <div class="form-group row">
        <label for="" class="col-3"></label>
        <div class="col-9 text-end">
            <button type="submit" class="btn btn-primary">ยืนยัน</button>
        </div>
    </div>

</form>