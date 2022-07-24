<?php

namespace App\Http\Livewire\SMComponent\Base;

use App\Models\Base\Position;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class SMPositionComponent extends Component
{
    use WithPagination;
    public $name, $id_edit, $id_delete;
    public $view_position_id, $view_position;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|unique:base_positions|max:30',
        ]);
    }

    public function storepositionData(){
        $this->validate([
            'name'=>'required|unique:base_positions|max:30',
        ]);

        //Add Data
        $position = new Position();
        $position->name = $this->name;
        $position->save();

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        $this->name = '';

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->id_edit = '';
    }
    
    public function editPosition($id){
        $position = Position::where('id', $id)->first();

        $this->id_edit=$position->id;
        $this->name=$position->name;

        $this->dispatchBrowserEvent('show-edit-position-modal');
    }

    public function editPositionData()
    {
        $this->validate([
            'name'=>'required|unique:base_positions|max:30',
        ]);

        $position = Position::where('id', $this->id_edit)->first();

        //Add Edit Data
        $position->name = $this->name;

        $position->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewPositionDetails($id){
        $position = Position::where('id', $id)->first();

        $this->view_position_id=$position->id;
        $this->view_position=$position->name;

        $this->dispatchBrowserEvent('show-view-position-modal');
    }

    public function closeviewPositionModal()
    {
        $this->view_position_id = '';
        $this->view_position = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        Position::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function render()
    {
        // get all data
        $positions = Position::paginate(5);

        return view('livewire.s-m-component.Base.s-m-position-component',['positions'=>$positions])
        ->layout('livewire.layouts.sm-base');
        
    }
}
