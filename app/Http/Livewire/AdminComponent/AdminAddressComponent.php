<?php

namespace App\Http\Livewire\AdminComponent;

use App\Models\Base\Address\District;
use App\Models\Base\Address\Province;
use App\Models\Base\Tambon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAddressComponent extends Component
{
    use WithPagination;
    public $name_th,$name_en, $id_edit;
    public $view_address_id, $view_province_name,$view_amphure_name,$view_district_name,$view_zip_code;

    public $messages = array(
        'name_th.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name_en.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name_th.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
        'name_en.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name_th'=>'required|unique:name_th',
            'name_en'=>'required|unique:name_en',
        ]);
    }
    
    public function editNameTitle($id){
        $addresses = Province::where('id', $id)->first();

        $this->id_edit=$addresses->id;
        $this->name_th=$addresses->name_th;
        $this->name_en=$addresses->name_en;

        $this->dispatchBrowserEvent('show-edit-nametitle-modal');
    }

    // public function editNameTitleData()
    // {
    //     $this->validate([
    //         'name_th'=>'required|unique:name_th',
    //         'name_en'=>'required|unique:name_en',
    //     ]);

    //     $addresses = Province::where('id', $this->id_edit)->first();

    //     //Add Edit Data
    //     $addresses->name_th = $this->name_th;
    //     $addresses->name_en = $this->name_en;

    //     $addresses->save();

    //     session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

    //     //hide modal adter add data success
    //     $this->dispatchBrowserEvent('close-modal');

    //     return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    // }

    //View
    public function viewNameTitleDetails($id){
        $addresses = Province::where('id', $id)->first();

        $this->view_address_id=$addresses->id;
        $this->view_province_name=$addresses->name;

        $this->dispatchBrowserEvent('show-view-nametitle-modal');
    }

    public function closeViewNameTitleModal()
    {
        $this->view_address_id = '';
        $this->view_nametitle = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    //----------------------- GET Amphoes Districts Zipcodes
    public function getAmphoes(Request $request)
    {
        $province = $request->get('province');
        $amphoes = Tambon::select('amphoe')
            ->where('province', 'like', "%$province%")
            ->distinct()
            ->get();

        return $amphoes;
        // dd($amphoes);
    }
    
    public function getDistricts(Request $request) 
    {
        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambons = Tambon::select('tambon')
        ->where('province', 'like', "%$province%")
        ->where('amphoe', 'like', "%$amphoe%")
            ->distinct()
            ->get();
        // $amphoe = $request->get('amphoe');
        // $tambons = Tambon::select('id', 'tambon')
        //     ->where('amphoe_code',$amphoe)
        //     ->distinct()
        //     ->get();
        return $tambons;
    }
    
    public function getZipcodes(Request $request)
    {
        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambon = $request->get('tambon');
        $zipcodes = Tambon::select('zipcode')
        ->where('province', 'like', "%$province%")
        ->where('amphoe', 'like', "%$amphoe%")
        ->where('tambon', 'like', "%$tambon%")
        ->get();
        return $zipcodes;
    }
    // End----------------------- GET Amphoes Districts Zipcodes

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        District::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function render()
    {
        // get all data
        $addresses = Province::join('amphures','provinces.id','=',
        'amphures.province_id')
        ->join('districts','amphures.id','=',
        'districts.amphure_id')
        ->paginate(5, array('provinces.name_th as province_name',
        'amphures.name_th as amphure_name',
        'districts.name_th as district_name',
        'districts.id as district_id',
        'districts.zip_code',
        'districts.status'));

        return view('livewire.admin-component.admin-address-component',['addresses'=>$addresses])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.admin-base');
        
    }
}
