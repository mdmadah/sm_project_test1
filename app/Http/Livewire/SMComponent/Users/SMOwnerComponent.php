<?php

namespace App\Http\Livewire\SMComponent\Users;

use App\Models\Base\Address\Amphure;
use App\Models\Base\Address\District;
use App\Models\Base\Address\Province;
use App\Models\Base\Nametitle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMOwnerComponent extends Component
{
    use WithPagination;
    public $name, $id_edit, $id_delete;
    public $view_name, $view_ogan_name, $view_email, $view_phone, $view_ogan_phone, $view_adderss;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|unique:base_name_titles|max:30',
        ]);
    }

    public function storeOwnerUserData(){
        $this->validate([
            'name'=>'required|unique:base_name_titles|max:30',
        ]);

        //Add Data
        $nametitle = new Nametitle();
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
    
    public function editOwnerUser($id){
        $nametitle = Nametitle::where('id', $id)->first();

        $this->id_edit=$nametitle->id;
        $this->name=$nametitle->name;

        $this->dispatchBrowserEvent('show-edit-nametitle-modal');
    }

    public function editOwnerUserData()
    {
        $this->validate([
            'name'=>'required|unique:base_name_titles|max:30',
        ]);

        $nametitle = Nametitle::where('id', $this->id_edit)->first();

        //Add Edit Data
        $nametitle->name = $this->name;

        $nametitle->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewOwnerUserDetails($id){
        $nametitle = Nametitle::where('id', $id)->first();

        // $this->$view_name=$users->lastname;
        // $this->$view_ogan_name=$users->id;
        // $this->$view_email=$users->id;
        // $this->$view_com_phone=$users->id;
        // $this->$view_ogan_phone=$users->id;
        // $this->$view_adderss=$users->id;

        $this->dispatchBrowserEvent('show-view-nametitle-modal');
    }

    public function closeViewOwnerUserModal()
    {
        $this->view_nametitle_id = '';
        $this->view_nametitle = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        User::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
            'st'=>$status,
            'id'=>$id 
        ], 200);
    }

    public function render()
    {
        // get all data
        $nametitle = DB::table('base_name_titles')
        ->where('status', 1)->get();
        $position = DB::table('base_positions')
        ->where('status', 1)->get();
        
        $users = User::join('user_owner_details','users.id','=',
        'user_owner_details.user_id')
        ->where('users.role', '=','4')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'user_owner_details.organ_name_en as organ_name',
        'users.id as id',
        'users.status'));

        $provinces = Province::select('name_th')->distinct()->get();
        $amphoes = Amphure::select('name_th')->distinct()->get();
        $tambons = District::select('name_th')->distinct()->get();

        return view('livewire.s-m-component.users.s-m-owner-component',
        ['users'=>$users, 'nametitle'=>$nametitle, 'position'=>$position, 'provinces'=>$provinces, 'amphoes'=>$amphoes, 'tambons'=>$tambons])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }
}
