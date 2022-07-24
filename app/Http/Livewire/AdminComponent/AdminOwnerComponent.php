<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\Address\District;
use App\Models\Base\Nametitle;
use App\Models\Base\Tambon;
use App\Models\User;
use App\Models\User_owner_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminOwnerComponent extends Component
{
    public $selectedProvince = null;
    public $selectedAmphoe = null;
    public $selectedTambon = null;
    public $provinces ,$amphoes, $tambons, $zipcode ;

    public $name_th, $name_en, $f_name, $l_name, $phone, $organ_phone,
    $email, $no, $mu, $street, $password ,$nametitle;

    // view 
    public $view_organ_name_th ,$view_organ_name_en ,$view_agent_name ;
    public $view_organ_phone ,$view_agent_phone ,$view_email;
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

    public function storeOwnerUserData(){
        // //Add Data
        $userowner = new User();
        $detailowner = new User_owner_detail();
        
        $userowner->nt_id = $this->nametitle;
        $userowner->email = $this->email;
        $userowner->firstname = $this->f_name;
        $userowner->lastname = $this->l_name;
        $userowner->phone = $this->phone;
        $userowner->role = 4;
        $userowner->password = Hash::make($this->password);
                
        $detailowner->organ_name_th = $this->name_th;
        $detailowner->organ_name_en = $this->name_en;
        $detailowner->organ_no = $this->no;
        $detailowner->organ_mu = $this->mu;
        $detailowner->organ_phone = $this->organ_phone;
        $detailowner->organ_street = $this->street;
        $detailowner->organ_province = $this->selectedProvince;
        $detailowner->organ_amphure = $this->selectedAmphoe;
        $detailowner->organ_district = $this->selectedTambon;
        $detailowner->organ_postcode = $this->zipcode;
        $userowner->save();
        $userowner->owner_detail()->save($detailowner);

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->closeOwnerUserModal();
    }

    // public function resetInputs()
    // {
    //     $this->name = '';
    //     $this->id_edit = '';
    // }
    
    public function editOwnerUser($id){
        // get data
        $nametitles = DB::table('base_name_titles')
        ->where('status', 0)->get();

        $user = User::where('id', $id)->first();
        $this->edit_id = $id;

        $this->name_th = $user->owner_detail->organ_name_th;
        $this->name_en = $user->owner_detail->organ_name_en;
        $this->organ_phone = $user->owner_detail->organ_phone;
        $this->f_name = $user->firstname;
        $this->l_name = $user->lastname;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->no = $user->owner_detail->organ_no;
        $this->mu = $user->owner_detail->organ_mu;
        $this->street = $user->owner_detail->organ_street;
        $this->nametitle = $user->nt_id;
        $this->selectedProvince = $user->owner_detail->organ_province;
        $this->selectedAmphoe = $user->owner_detail->organ_amphure;
        $this->selectedTambon = $user->owner_detail->organ_district;
        $this->zipcode = $user->owner_detail->organ_postcode;
    

        $this->dispatchBrowserEvent('show-edit-nametitle-modal');
    }

    public function editOwnerUserData()
    {
        // $this->validate([
        //     'name'=>'required|unique:base_name_titles|max:30',
        // ]);

        $user = User::where('id', $this->edit_id)->first();
        $detail = User_owner_detail::where('user_id', $this->edit_id)->first();
        //Add Edit Data
        // $this->edit_id = $id;
        
        $detail->organ_name_th = $this->name_th;
        $detail->organ_name_en = $this->name_en;
        $detail->organ_phone = $this->organ_phone;
        $user->firstname = $this->f_name;
        $user->lastname = $this->l_name;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $detail->organ_no = $this->no;
        $detail->organ_mu = $this->mu;
        $detail->organ_street = $this->street;
        $user->nt_id = $this->nametitle;
        $detail->organ_province = $this->selectedProvince;
        $detail->organ_amphure = $this->selectedAmphoe;
        $detail->organ_district = $this->selectedTambon;
        $detail->organ_postcode = $this->zipcode;

        $user->save();
        $detail->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->closeOwnerUserModal();

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    // //View
    public function viewOwnerUserDetails($id){
        $user = User::where('id', $id)->first();
        $detail = User_owner_detail::where('user_id', $id)->first();

        $this->view_organ_name_th = $detail->organ_name_th;
        $this->view_organ_name_en = $detail->organ_name_en;
        $this->view_agent_name = 
            Nametitle::where('id',$user->nt_id)->value('name')." ".
            $user->firstname." ".$user->lastname;
        $this->view_organ_phone = $detail->organ_phone;
        $this->view_agent_phone = $user->phone;
        $this->view_email = $user->email;

        // $adrs_1 = "บ้านเลขที่ ";
        if($detail->organ_no!=null){
            $this->view_no = $detail->organ_no;
        }else{
            $this->view_no = "-";
        }
        if($detail->organ_mu!=null){
            $this->view_mu = $detail->organ_mu;
        }else{
            $this->view_mu = "-";
        }
        if($detail->organ_street!=null){
            $this->view_street = $detail->organ_street;
        }else{
            $this->view_street = "-";
        }
        if($detail->organ_district!=null){
            $this->view_tambon = $detail->organ_district;
        }else{
            $this->view_tambon = "-";
        }
        if($detail->organ_amphure!=null){
            $this->view_amphoe = $detail->organ_amphure;
        }else{
            $this->view_amphoe = "-";
        }
        if($detail->organ_province!=null){
            $this->view_province = $detail->organ_province;
        }else{
            $this->view_province = "-";
        }
        if($detail->organ_postcode!=null){
            $this->view_zipcode = $detail->organ_postcode;
        }else{
            $this->view_zipcode = "-";
        }
        
        $this->dispatchBrowserEvent('show-view-nametitle-modal');
    }

    public function closeOwnerUserModal()
    {
        $this->edit_id = 0;
        $this->name_th = '';
        $this->name_en = '';
        $this->nametitle = '';
        $this->f_name = '';
        $this->l_name = '';
        $this->phone = '';
        $this->organ_phone = '';
        $this->email = '';
        $this->no = '';
        $this->mu = '';
        $this->street = '';
        $this->emailuser = '';
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
        
        // $this->provinces = Tambon::select('province')
        // ->distinct()->get();
        // $this->provinces = Tambon::select('province_code','province')
        // ->distinct()->get();
        
        $users = User::join('user_owner_details','users.id','=',
        'user_owner_details.user_id')
        ->where('users.role', '=','4')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'user_owner_details.organ_name_en as organ_name',
        'users.id as id',
        'users.status'));
        
        return view('livewire.admin-component.admin-owner-component'
        ,['users'=>$users, 'nametitles'=>$nametitles 
        ])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.admin-base');
    }
}
