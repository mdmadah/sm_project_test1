<?php

namespace App\Http\Livewire\SMComponent\Base;

use App\Models\Base\Address\District;
use App\Models\Base\Address\Province;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMAddressComponent extends Component
{
    use WithPagination;
    public $name_th,$name_en, $id_edit, $id_delete;
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
        $amphoes = DB::table('amphures')
        ->where('province_id', $province)
            ->distinct()
            ->get();

        dd($amphoes);
    }
    
    public function getDistricts(Request $request) 
    {
        $province = $request->get('province');
        $amphoe = $request->get('amphoe');
        $tambons = Province::join('amphures','provinces.id','=',
        'amphures.province_id')
        ->join('districts','amphures.id','=',
        'districts.amphure_id')
        ->select('districts.name_th')
        ->where('provinces.id', 'like', "%$province%")
        ->where('amphures.id', 'like', "%$amphoe%")
            ->distinct()
            ->get();
        return $tambons;
    }
    
    public function getZipcodes(Request $request)
    {
        $tambon = $request->get('tambon');
        $zipcodes = District::select('zip_code')
            ->where('id', $tambon)
            ->get();
        return $zipcodes;
    }
    // End----------------------- GET Amphoes Districts Zipcodes

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

        return view('livewire.s-m-component.base.s-m-address-component',['addresses'=>$addresses])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }
}
