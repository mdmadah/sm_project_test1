<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\UserStoryType;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUserStoryTypeComponent extends Component
{
    use WithPagination;
    public $name, $id_edit;
    public $view_userstorytype_id, $view_userstorytype;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนประเภทของกิจกรรม",
        'name.max'=>"*ประเภทของกิจกรรมไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|unique:base_activity_types|max:30',
        ]);
    }

    public function storeuserstorytypeData(){
        $this->validate([
            'name'=>'required|unique:base_activity_types|max:30',
        ]);

        //Add Data
        $userstorytype = new UserStoryType();
        $userstorytype->name = $this->name;
        $userstorytype->save();

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
    
    public function editUserStoryType($id){
        $userstorytype = UserStoryType::where('id', $id)->first();

        $this->id_edit=$userstorytype->id;
        $this->name=$userstorytype->name;

        $this->dispatchBrowserEvent('show-edit-userstorytype-modal');
    }

    public function editUserStoryTypeData()
    {
        $this->validate([
            'name'=>'required|unique:base_activity_types|max:30',
        ]);

        $userstorytype = UserStoryType::where('id', $this->id_edit)->first();

        //Add Edit Data
        $userstorytype->name = $this->name;

        $userstorytype->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewUserStoryTypeDetails($id){
        $userstorytype = UserStoryType::where('id', $id)->first();

        $this->view_userstorytype_id=$userstorytype->id;
        $this->view_userstorytype=$userstorytype->name;

        $this->dispatchBrowserEvent('show-view-userstorytype-modal');
    }

    public function closeviewUserStoryTypeModal()
    {
        $this->view_userstorytype_id = '';
        $this->view_userstorytype = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        UserStoryType::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function render()
    {
        // get all data
        $userstorytypes = UserStoryType::paginate(5);

        return view('livewire.admin-component.admin-user-story-type-component',['userstorytypes'=>$userstorytypes])
        ->layout('livewire.layouts.admin-base');
        
    }
}
