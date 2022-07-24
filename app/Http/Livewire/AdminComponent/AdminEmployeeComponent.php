<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\Nametitle;
use App\Models\Base\Position;
use App\Models\Base\Tambon;
use App\Models\User;
use App\Models\User_employee_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminEmployeeComponent extends Component
{
    public $selectedProvince = null;
    public $selectedAmphoe = null;
    public $selectedTambon = null;
    public $provinces ,$amphoes, $tambons, $zipcode ;

    public $facebook, $line, $f_name, $l_name, $phone, $position,
    $email, $no, $mu, $street, $password ,$nametitle;

    // view 
    public $view_facebook ,$view_position ,$view_user_name ;
    public $view_phone ,$view_line ,$view_email;
    public $view_no, $view_mu, $view_street, $view_zipcode;
    public $view_province ,$view_amphoe, $view_tambon ;

    public $edit_id = 0;

    public function mount($selectedTambon = null)
    {
        $this->provinces = Tambon::select('province')
        ->where('status', 0)->distinct()->orderBy('tambons.province', 'asc')->get()->toArray();
        
        
        $this->amphoes = collect();
        $this->tambons = collect();
        $this->zipcode = null;
        $this->selectedTambon = $selectedTambon;

        if (!is_null($selectedTambon)) {

            $district = Tambon::find('tambons.tambon',$selectedTambon)->first();
            // dd($district);
            if ($district) {
                $this->tambons = Tambon::select('tambon')
                ->where('amphoe', '=', $district->amphoe)
                ->distinct()->orderBy('tambons.tambon', 'asc')->get()->toArray();
                        
                $this->amphoes = Tambon::select('amphoe')
                ->where('province', '=', $district->province)
                ->distinct()->orderBy('tambons.amphoe', 'asc')->get()->toArray();
                $this->selectedProvince = $district->province;
                $this->selectedAmphoe = $district->amphoe;
                $this->zipcode = Tambon::where('tambon', '=', $district->tambon)
                ->value('zipcode');
            }
        }
    }
    public function updatedSelectedProvince($province)
    {
        $this->amphoes = $this->amphoes = Tambon::select('amphoe')
        ->where('province', '=', $province)
        ->distinct()->orderBy('tambons.amphoe', 'asc')->get()->toArray();

        $this->selectedAmphoe = null;
        $this->selectedTambon = null;
        $this->zipcode = null;
    }

    public function updatedSelectedAmphoe($amphoe)
    {
        if (!is_null($amphoe)) {
            $this->tambons = Tambon::select('tambon')
            ->where('amphoe', '=', $amphoe)
            ->distinct()->orderBy('tambons.tambon', 'asc')->get()->toArray();
        }
        $this->selectedTambon = null;
        $this->zipcode = null;

    }

    public function updatedSelectedTambon($tambon)
    {
        $this->zipcode = Tambon::
                where('tambon', '=', $tambon)
                ->value('zipcode');
    }

    public $messages = array(
        'name_th.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name_th.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    // public function update($fields){
    //     $this->validateOnly($fields, [
    //         'name'=>'required|unique:base_name_titles|max:30',
    //     ]);
    // }

    public function storeEmployeeUserData(){

        // //Add Data
        $user = new User();
        $detailuser = new User_employee_detail();
        
        $user->nt_id = $this->nametitle;
        $user->email = $this->email;
        $user->firstname = $this->f_name;
        $user->lastname = $this->l_name;
        $user->phone = $this->phone;
        $user->password = Hash::make($this->password);
        if($this->position == '1')
        {
            $user->role = 1;
        }
        elseif($this->position =='2')
        {
            $user->role = 2;
        }
        else
        {
            $user->role = 3;
        }
                
        $detailuser->facebook = $this->facebook;
        $detailuser->line = $this->line;
        $detailuser->no = $this->no;
        $detailuser->mu = $this->mu;
        $detailuser->position_id = $this->position;
        $detailuser->street = $this->street;
        $detailuser->province = $this->selectedProvince;
        $detailuser->amphure = $this->selectedAmphoe;
        $detailuser->district = $this->selectedTambon;
        $detailuser->postcode = $this->zipcode;
        $user->save();
        $user->owner_detail()->save($detailuser);

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->closeEmployeeUserModal();
    }

    // public function resetInputs()
    // {
    //     $this->name = '';
    //     $this->id_edit = '';
    // }
    
    public function editEmployeeUser($id){
        // get data
        $nametitles = DB::table('base_name_titles')
        ->where('status', 0)->get();
        $positions = DB::table('base_positions')
        ->where('status', 0)->get();

        $user = User::where('id', $id)->first();
        $this->edit_id = $id;

        $this->facebook = $user->employee_detail->facebook;
        $this->line = $user->employee_detail->line;
        $this->position = $user->employee_detail->position_id;
        $this->f_name = $user->firstname;
        $this->l_name = $user->lastname;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->no = $user->employee_detail->no;
        $this->mu = $user->employee_detail->mu;
        $this->street = $user->employee_detail->street;
        $this->nametitle = $user->nt_id;
        $this->selectedProvince = $user->employee_detail->province;
        $this->selectedAmphoe = $user->employee_detail->amphure;
        $this->selectedTambon = $user->employee_detail->district;
        $this->zipcode = $user->employee_detail->postcode;
    

        $this->dispatchBrowserEvent('show-edit-nametitle-modal');
    }

    public function editEmployeeUserData()
    {
        // $this->validate([
        //     'name'=>'required|unique:base_name_titles|max:30',
        // ]);

        $user = User::where('id', $this->edit_id)->first();
        $detail = User_employee_detail::where('user_id', $this->edit_id)->first();
        //Add Edit Data
        // $this->edit_id = $id;
        
        $detail->facebook = $this->facebook;
        $detail->line = $this->line;
        $detail->position_id = $this->position;
        $user->firstname = $this->f_name;
        $user->lastname = $this->l_name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $detail->no = $this->no;
        $detail->mu = $this->mu;
        $detail->street = $this->street;
        $user->nt_id = $this->nametitle;
        $detail->province = $this->selectedProvince;
        $detail->amphure = $this->selectedAmphoe;
        $detail->district = $this->selectedTambon;
        $detail->postcode = $this->zipcode;

        $user->save();
        $detail->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->closeEmployeeUserModal();

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    // //View
    public function viewEmployeeUserDetails($id){
        $user = User::where('id', $id)->first();
        $detail = User_employee_detail::where('user_id', $id)->first();

        $this->view_facebook = $detail->facebook;
        $this->view_line = $detail->line;
        $this->view_user_name = 
            Nametitle::where('id',$user->nt_id)->value('name')." ".
            $user->firstname." ".$user->lastname;
        $this->view_position = Position::where('id',$detail->position_id)->value('name');
        $this->view_phone = $user->phone;
        $this->view_email = $user->email;

        // $adrs_1 = "บ้านเลขที่ ";
        if($detail->no!=null){
            $this->view_no = $detail->no;
        }else{
            $this->view_no = "-";
        }
        if($detail->mu!=null){
            $this->view_mu = $detail->mu;
        }else{
            $this->view_mu = "-";
        }
        if($detail->street!=null){
            $this->view_street = $detail->street;
        }else{
            $this->view_street = "-";
        }
        if($detail->district!=null){
            $this->view_tambon = $detail->district;
        }else{
            $this->view_tambon = "-";
        }
        if($detail->amphure!=null){
            $this->view_amphoe = $detail->amphure;
        }else{
            $this->view_amphoe = "-";
        }
        if($detail->province!=null){
            $this->view_province = $detail->province;
        }else{
            $this->view_province = "-";
        }
        if($detail->postcode!=null){
            $this->view_zipcode = $detail->postcode;
        }else{
            $this->view_zipcode = "-";
        }
        
        $this->dispatchBrowserEvent('show-view-nametitle-modal');
    }

    public function closeEmployeeUserModal()
    {
        $this->edit_id = 0;
        $this->facebook = '';
        $this->line = '';
        $this->nametitle = '';
        $this->f_name = '';
        $this->l_name = '';
        $this->phone = '';
        $this->position = '';
        $this->email = '';
        $this->no = '';
        $this->mu = '';
        $this->street = '';
        $this->password = '';
        $this->selectedProvince = null;
        $this->selectedAmphoe = null;
        $this->selectedTambon = null;
        $this->zipcode = '';

        $this->view_organ_name_th = '';
        $this->view_organ_name_en = '';
        $this->view_agent_name = '';
                
        $this->view_organ_phone = '';
        $this->view_agent_phone = '';
        $this->view_email = '';
                
        $this->view_address_1 = '';
        $this->view_address_2 = '';
        $this->view_address_3 = '';
    
        $this->dispatchBrowserEvent('close-modal');
    }

    // public function closeEditOwnerUserModal()
    // {
    //     $this->view_organ_name_th = '';
    //     $this->view_organ_name_en = '';
    //     $this->view_agent_name = '';
                
    //     $this->view_organ_phone = '';
    //     $this->view_agent_phone = '';
    //     $this->view_email = '';
                
    //     $this->view_address_1 = '';
    //     $this->view_address_2 = '';
    //     $this->view_address_3 = '';
    
    //     $this->dispatchBrowserEvent('close-modal');
    // }

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

        // get data
        $nametitles = DB::table('base_name_titles')
        ->where('status', 0)->get();
        $positions = DB::table('base_positions')
        ->where('status', 0)->get();
        
        // $this->provinces = Tambon::select('province')
        // ->distinct()->get();
        // $this->provinces = Tambon::select('province_code','province')
        // ->distinct()->get();
        
        $users = User::join('user_employee_details','users.id','=',
        'user_employee_details.user_id')
        ->join('base_positions','base_positions.id','=',
        'user_employee_details.position_id')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'base_positions.name as position',
        'users.id as id',
        'users.status'));

        return view('livewire.admin-component.admin-employee-component'

        // return view('livewire.admin-component.admin-owner-component'
        ,['users'=>$users, 'nametitles'=>$nametitles , 'positions'=>$positions
        ])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.admin-base');
    }
}
