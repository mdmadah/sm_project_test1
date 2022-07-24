<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\Company;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyComponent extends Component
{
    use WithPagination;
    public $name, $id_edit, $id_delete;
    public $view_nametitle_id, $view_nametitle;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|unique:base_name_titles|max:30',
        ]);
    }

    public function storeNameTitleData(){
        $this->validate([
            'name'=>'required|unique:base_name_titles|max:30',
        ]);

        //Add Data
        $nametitle = new Company();
        $nametitle->name = $this->name;
        // ->user_id = Auth::user()->id;
        $nametitle->save();

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
    
    public function editNameTitle($id){
        $nametitle = Company::where('id', $id)->first();

        $this->id_edit=$nametitle->id;
        $this->name=$nametitle->name;

        $this->dispatchBrowserEvent('show-edit-nametitle-modal');
    }

    public function editNameTitleData()
    {
        $this->validate([
            'name'=>'required|unique:base_name_titles|max:30',
        ]);

        $nametitle = Company::where('id', $this->id_edit)->first();

        //Add Edit Data
        $nametitle->name = $this->name;

        $nametitle->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //Delete
    public function deleteNameTitle($id)
    {
        // $nametitle = Base_name_title::where('id', $id)->first();
        $this->id_delete = $id;

        $this->dispatchBrowserEvent('show-delete-nametitle-modal');
    }

    public function deleteNameTitleData()
    {
        $nametitle = Company::where('id', $this->id_delete)->first();
        $nametitle->delete();

        session()->flash('message',"ลบข้อมูลเรียบร้อย");

        $this->dispatchBrowserEvent('close-modal');

        $this->id_delete = '';

    }

    public function cancel()
    {
        $this->id_delete = '';
    }

    //View
    public function viewCompanyDetails($id){
        $nametitle = Company::where('id', $id)->first();

        $this->view_nametitle_id=$nametitle->id;
        $this->view_nametitle=$nametitle->name;

        $this->dispatchBrowserEvent('show-view-nametitle-modal');
    }

    public function closeViewCompanyModal()
    {
        $this->view_nametitle_id = '';
        $this->view_nametitle = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        // get all data
        $nametitles = Company::paginate(5);
        // all();
        // paginate(5);

        return view('livewire.admin-component.admin-name-title-component'
        ,['nametitles'=>$nametitles])
        ->layout('livewire.layouts.admin-base');
        
    }
}
