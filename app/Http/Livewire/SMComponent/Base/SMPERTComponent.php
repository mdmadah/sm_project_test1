<?php

namespace App\Http\Livewire\SMComponent\Base;

use App\Models\Base\PERT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMPERTComponent extends Component
{
    use WithPagination;
    public $ET=null, $NT=null, $LT=null, $at_id=0, $id_edit=0;
    public $view_at_name, $view_ET, $view_NT, $view_LT;

    public $messages = array(
        'ET.required'=>"*กรุณาป้อนระยะเวลาที่เร็วที่สุด",
        'NT.required'=>"*กรุณาป้อนระยะเวลาปกติ",
        'LT.required'=>"*กรุณาป้อนระยะเวลาที่ช้าที่สุด",
        'at_id.required'=>"*กรุณาเลือกประเภทกิจกรรม",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'at_id'=>'required',
            'ET'=>'required',
            'NT'=>'required',
            'LT'=>'required',
            
        ]);
    }

    public function storepertData(){
        $this->validate([
            'at_id'=>'required',
            'ET'=>'required',
            'NT'=>'required',
            'LT'=>'required',
            
        ]);

        //Add Data
        $pert = new PERT();

        // $this->form['at_id'] = $this->id;
        $pert->at_id = $this->at_id;
        $pert->ET = $this->ET;
        $pert->NT = $this->NT;
        $pert->LT = $this->LT;

        $pert->save();

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        $this->name = '';

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->id_edit = '';
        $this->at_id = '';
        $this->ET = '';
        $this->NT = '';
        $this->LT = '';

    }
    
    public function editPERT($id){
        $pert = PERT::where('id', $id)->first();

        $this->id_edit=$pert->id;
        $this->at_id = $pert->at_id;
        $this->ET = $pert->ET;
        $this->NT = $pert->NT;
        $this->LT = $pert->LT;

        $this->dispatchBrowserEvent('show-edit-pert-modal');
    }

    public function editPERTData()
    {
        // $this->validate([
        //     'name'=>'required|unique:base_perts|max:30',
        // ]);

        $pert = PERT::where('id', $this->id_edit)->first();

        //Add Edit Data
        $pert->at_id = $this->at_id;
        $pert->ET = $this->ET;
        $pert->NT = $this->NT;
        $pert->LT = $this->LT;

        $pert->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewPERTDetails($id){
        // $pert = PERT::where('id', $id)->first();
        $pert = PERT::join('base_activity_types',
        'base_perts.at_id','=',
        'base_activity_types.id')
        ->where('base_perts.id', $id)
        ->select('base_activity_types.name as at_name',
        'base_perts.*')->first();

        $this->view_at_name=$pert->at_name;
        $this->view_ET=$pert->ET;
        $this->view_NT=$pert->NT;
        $this->view_LT=$pert->LT;

        $this->dispatchBrowserEvent('show-view-pert-modal');
    }

    public function closeviewPERTModal()
    {
        $this->view_at_name='';
        $this->view_ET='';
        $this->view_NT='';
        $this->view_LT='';
        
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        PERT::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function render()
    {
        // get all data
        $act_type = DB::table('base_activity_types')
        ->where('status', 0)->get();
        $perts = PERT::join('base_activity_types',
        'base_perts.at_id','=',
        'base_activity_types.id')
        ->paginate(5,array('base_activity_types.name as at_name',
        'base_perts.*'));

        return view('livewire.s-m-component.Base.s-m-p-e-r-t-component',['act_type'=>$act_type,'perts'=>$perts])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
        
    }
}
