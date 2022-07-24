<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\Priority;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPriorityComponent extends Component
{
    use WithPagination;
    public $name, $id_edit;
    public $view_priority_id, $view_priority;

    public $messages = array(
        'name.required'=>"*กรุณาป้อน Priority",
        'name.max'=>"*Priority ไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|unique:base_priorities|max:30',
        ]);
    }

    public function storepriorityData(){
        $this->validate([
            'name'=>'required|unique:base_priorities|max:30',
        ]);

        //Add Data
        $priority = new Priority();
        $priority->name = $this->name;
        $priority->save();

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
    
    public function editPriority($id){
        $priority = Priority::where('id', $id)->first();

        $this->id_edit=$priority->id;
        $this->name=$priority->name;

        $this->dispatchBrowserEvent('show-edit-priority-modal');
    }

    public function editPriorityData()
    {
        $this->validate([
            'name'=>'required|unique:base_priorities|max:30',
        ]);

        $priority = Priority::where('id', $this->id_edit)->first();

        //Add Edit Data
        $priority->name = $this->name;

        $priority->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewPriorityDetails($id){
        $priority = Priority::where('id', $id)->first();

        $this->view_priority_id=$priority->id;
        $this->view_priority=$priority->name;

        $this->dispatchBrowserEvent('show-view-priority-modal');
    }

    public function closeviewPriorityModal()
    {
        $this->view_priority_id = '';
        $this->view_priority = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        Priority::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function render()
    {
        // get all data
        $prioritys = Priority::paginate(5);

        return view('livewire.admin-component.admin-priority-component',['prioritys'=>$prioritys])
        ->layout('livewire.layouts.admin-base');
        
    }
}
