<?php

namespace App\Http\Livewire\SMComponent\Software;

use App\Models\Software\Activity;
use App\Models\Software\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMActivityComponent extends Component
{
    use WithPagination;
    public $name, $id_edit, $owner_id, $sm_id, $duration, $allBudget, $expectedBudget, $signDate, $startDate, $endDate;
    public $view_name, $view_owner_id, $view_owner_name, $view_sm_id, $view_sm_name, $view_duration, $view_allBudget, $view_expectedBudget, $view_signDate, $view_startDate, $view_endDate;

    public $messages = array(
        'name.required'=>"*กรุณาป้อนคำนำชื่อ",
        'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        // $this->validateOnly($fields, [
        //     'name'=>'required|unique:base_perts|max:30',
        // ]);
    }

    public function storesoftwareData(){
        // $this->validate([
        //     'at_id'=>'required|unique:base_perts|max:30',
        // ]);

        //Add Data
        $software = new Software();

        // $this->form['at_id'] = $this->id;
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

        $this->resetInputs();
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

        $this->id_edit = $id;
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
        // $this->validate([
        //     'name'=>'required'
        //     |unique:softwares,name,'.$this->name_edit.'',
        // ]);

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
        // $software = Software::where('id', $id)->first();
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
    
    public function getCompany(Request $request){
        $input_sw = $request->get('input_sw');

        $Company = Software::join('users',
        'softwares.owner_id','=','users.id')
        ->join('user_owner_details',
        'user_owner_details.user_id','=','users.id')
        ->select('user_owner_details.organ_name_th')
        ->where('softwares.id', 'like', "%$input_sw%")
        ->get();
        return $Company;
    }

    // getUST
    public function getUST(Request $request)
    {
        $sw_id = $request->get('input_sw');
        $UST = Software::join('software_user_stories',
        'softwares.id','=','software_user_stories.sw_id')
        ->join('base_activity_types',
        'software_user_stories.at_id','=',
        'base_activity_types.id')
        ->select('base_activity_types.name as ust_name',
        'base_activity_types.id as ust_id')
        ->where('softwares.id', $sw_id)
        ->distinct()->get();
        return $UST;
    }

    public function getUS(Request $request)
    {
        $input_ust = $request->get('input_ust');


        $US = Software::join('software_user_stories','softwares.id','=',
        'software_user_stories.sw_id')
        ->select('software_user_stories.user_story_detail as us_name',
        'software_user_stories.id as us_id')
        ->where('software_user_stories.at_id', $input_ust)
        ->get();
        return $US;
    }

    public function getteam(){
        $teams = DB::table('users')
        ->where('role', 3)
        ->where('status', 0)->get();
        return $teams;
    }

    public function render()
    {
        $softwares = DB::table('softwares')
        ->where('status', 'กำลังดำเนินการ')->get();
        $teams = DB::table('users')
        ->where('role', 3)
        ->where('status', 0)->get();

        $Act = Activity::join(
        'software_user_stories','software_user_stories.id','=',
        'software_activities.us_id')
        ->join('softwares','softwares.id','=',
        'software_user_stories.sw_id')
        ->join('users','users.id','=',
        'software_activities.ts_id')
        ->orderBy('softwares.id', 'asc')
        ->orderBy('software_user_stories.id', 'asc')
        ->orderBy('software_activities.id', 'asc')
        ->paginate(5, array(
        'softwares.id as sw_id',
        'softwares.name as sw_name',
        'software_user_stories.id as us_id',
        'software_user_stories.user_story_detail as us_name',
        'software_activities.id as act_id',
        'software_activities.name as act_name',
        'software_activities.NT as act_NT',
        'software_activities.rush_day as act_rush_day',
        'users.firstname as ts_firstname',
        'users.lastname as ts_lastname'));

        return view('livewire.s-m-component.software.s-m-activity-component'
        ,['teams'=>$teams,'Act'=>$Act,'softwares'=>$softwares])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }

}
