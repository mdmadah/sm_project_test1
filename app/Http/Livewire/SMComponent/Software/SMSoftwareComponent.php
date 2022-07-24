<?php

namespace App\Http\Livewire\SMComponent\Software;

use App\Models\Software\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMSoftwareComponent extends Component
{
    use WithPagination;
    // add/edit
    public $name, $id_edit, $owner_id, $sm_id, $duration, $allBudget, $expectedBudget, $signDate, $startDate, $endDate;
    // view
    public $view_name, $view_owner_id, $view_owner_name, $view_sm_id, $view_sm_name, $view_duration;
    public $view_allBudget, $view_expectedBudget, $view_signDate, $view_startDate, $view_endDate;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'name'=>'required|max:30',
        ]);
    }

    public function storesoftwareData(){
        $this->validate([
            'name'=>'required|max:50',
        ]);

        //Add Data
        $software = new Software();

        $software->name = $this->name;
        $software->owner_id = $this->owner_id;
        $software->sm_id = $this->sm_id;
        $software->duration = $this->duration;
        
        $software->allBudget = $this->allBudget;
        $software->expectedBudget = $this->expectedBudget;
        $software->signDate = $this->signDate;
        $software->startDate = $this->startDate;
        $software->endDate = $this->endDate;

        $software->save();

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        // $this->resetInputs();
        // $this->name = '';

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {

        $this->id_edit = '';
        $this->name = '';
        $this->owner_id = '';
        $this->sm_id = '';
        $this->duration = '';
        $this->allBudget = '';
        $this->expectedBudget = '';
        $this->signDate = '';
        $this->startDate = '';
        $this->endDate = '';

        
        $this->view_name = '';
        $this->view_owner_name = '';
        $this->view_sm_name = '';
        $this->view_duration = '';
        $this->view_allBudget = '';
        $this->view_expectedBudget = '';
        $this->view_signDate = '';
        $this->view_startDate = '';
        $this->view_endDate = '';

    }
    
    public function editSoftware($id){
        $software = Software::where('id', $id)->first();

        $this->id_edit = $software->id;
        $this->name = $software->name;
        $this->owner_id = $software->owner_id;
        $this->sm_id = $software->sm_id;
        $this->duration = $software->duration;
        
        $this->allBudget = $software->allBudget;
        $this->expectedBudget = $software->expectedBudget;
        $this->signDate = $software->signDate;
        $this->startDate = $software->startDate;
        $this->endDate = $software->endDate;

        $this->dispatchBrowserEvent('show-edit-software-modal');
    }

    public function editSoftwareData()
    {

        $software = Software::where('id', $this->id_edit)->first();

        //Add Edit Data
        $software->name = $this->name;
        $software->owner_id = $this->owner_id;
        $software->sm_id = $this->sm_id;
        $software->duration = $this->duration;
        
        $software->allBudget = $this->allBudget;
        $software->expectedBudget = $this->expectedBudget;
        $software->signDate = $this->signDate;
        $software->startDate = $this->startDate;
        $software->endDate = $this->endDate;

        $software->save();
        
        // $this->resetInputs();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewSoftwareDetails($id){

        $software = Software::join('users as owner','softwares.owner_id','=',
        'owner.id')->join('users as sms','softwares.sm_id','=','sms.id')
        ->where('softwares.id', $id)
        ->select(
        'softwares.id as sw_id',
        'softwares.name as sw_name',
        'softwares.status as sw_status',
        'owner.firstname as ow_firstname',
        'owner.lastname as ow_lastname',
        'sms.firstname as sm_firstname',
        'sms.lastname as sm_lastname',
        'softwares.duration as duration',
        'softwares.allBudget as allBudget',
        'softwares.expectedBudget as expectedBudget',
        'softwares.signDate as signDate',
        'softwares.startDate as startDate',
        'softwares.endDate as endDate')->first()->toArray();

        $this->view_name = $software['sw_name'];
        $this->view_owner_name = $software['ow_firstname'].' '.$software['ow_lastname'];
        $this->view_sm_name = $software['sm_firstname'].' '.$software['sm_lastname'];
        $this->view_duration = $software['duration'];
        
        $this->view_allBudget = $software['allBudget'];
        $this->view_expectedBudget = $software['expectedBudget'];
        $this->view_signDate = $software['signDate'];
        $this->view_startDate = $software['startDate'];
        $this->view_endDate = $software['endDate'];

        $this->dispatchBrowserEvent('show-view-software-modal');
    }

    public function closeviewSoftwareModal()
    {
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeEditSoftwareModal()
    {
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        Software::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }

    public function getCompany(Request $request){
        $input_sw = $request->get('input_sw');

        $Company = Software::join('users as owner',
        'softwares.owner_id','=','owner.id')
        ->join('user_owner_details','user_owner_details.user_id','=',
        'owner.id')->select('user_owner_details.organ_name_th')
        ->where('softwares.id', 'like', "%$input_sw%")
        ->get();
        return $Company;
    }

    public function getUserStory(Request $request)
    {
        $ust_id = $request->get('ust_id');
        // $user = DB::table('users')->where('name', 'John')->first();

        $pert = DB::table('base_perts')
            ->where('tus_id', $ust_id)->first();
            // ->get();
        return $pert;
    }

    public function render()
    {
        // get all data
        $sms = DB::table('users')
        ->where('role', 2)
        ->where('status', 0)->get();
        $owners = DB::table('users')
        ->where('role', 4)
        ->where('status', 0)->get();

        $softwares = Software::join('users as owner','softwares.owner_id','=',
        'owner.id')->join('users as sms','softwares.sm_id','=','sms.id')
        ->paginate(5, array(
        'softwares.id as sw_id',
        'softwares.name as sw_name',
        'softwares.status as sw_status',
        'owner.firstname as ow_firstname',
        'owner.lastname as ow_lastname',
        'sms.firstname as sm_firstname',
        'sms.lastname as sm_lastname'));

        return view('livewire.s-m-component.software.s-m-software-component'
        ,['sms'=>$sms,'owners'=>$owners,'softwares'=>$softwares])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }
}
