<?php

namespace App\Http\Livewire\SMComponent\Software;

use App\Models\Software\Software;
use App\Models\Software\UserStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SMUserStoryComponent extends Component
{
    use WithPagination;
    // public $searchByProjectID = 0 ,$US;
    public $prio_id=null, $sw_id=null, $at_id=0, $id_edit=0, $us_budget = 0;
    public $input_company, $duration = 0;
    public $input_userstory, $input_ust_id,$USCount;
    public $view_sw_name, $view_us_id, $view_us, $view_ust, $view_du, $view_priority;

    protected $listeners = [
            'getPERTforInput'
    ];

    public $messages = array(
        'duration.required'=>"*กรุณาป้อนระยะเวลา",
        'duration.integer'=>"*กรุณาป้อนระยะเวลาใหม่",
        'duration.not_in'=>"*กรุณาป้อนระยะเวลาใหม่",
        // 'name.max'=>"*คำนำชื่อไม่ควรเกิน 30 ตัวอักษร",
    );

    public function update($fields){
        $this->validateOnly($fields, [
            'duration'=>'required|integer|not_in:0',
            // |between:1,10
        ]);
    }
    public function getPERTforInput($value)
    {
        if(!is_null($value)){
            // $this->duration = 100;
            // $ust_id = $request->get('ust_id');
        // $user = DB::table('users')->where('name', 'John')->first();

            $pert = DB::table('base_perts')
                ->where('at_id', $value)->first();
            $duration = ceil(($pert->ET + (4 * $pert->NT) + $pert->LT) / 6);
                    // txt.value = parseInt(pert);
            $this->duration = $duration;
                // ->get();
            // return $pert;

        }
            // $this->latitud = $value;
    }

    public function storeuserstoryData(){
        $this->validate([
            'duration'=>'required|integer|not_in:0',
            // |between:1,10
        ]);

        //Add Data
        $us = new UserStory();
        $US = UserStory::join('softwares',
        'softwares.id','=','software_user_stories.sw_id')
        ->where('software_user_stories.sw_id', $this->sw_id)->get();

        $USCount = count($US);
        if ($USCount>0) {
            $us->us_id = $USCount+1;
        } else {
            $us->us_id = 1;
        }
        
        $us->user_story_detail = $this->input_userstory;
        // $us->ow_id = $this->owner_id;

        $us->at_id = $this->input_ust_id;
        $us->duration = $this->duration;
        $us->prio_id = $this->prio_id;
        $us->sw_id = $this->sw_id;
        $us->us_budget = $this->us_budget;

        $us->save();

        session()->flash('message',"บันทึกข้อมูลเรียบร้อย");

        $this->user_story_detail = '';

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->id_edit = '';
        $this->at_id = '';
        $this->duration = 0;
        $this->prio_id = '';
        $this->sw_id = '';
        $this->us_budget = 0;

    }
    
    public function editUserStory($id){
        $pert = UserStory::where('id', $id)->first();

        $this->id_edit=$pert->id;
        $this->at_id = $pert->at_id;
        $this->duration = $pert->duration;
        $this->prio_id = $pert->prio_id;
        $this->sw_id = $pert->sw_id;
        $this->us_budget = $pert->us_budget;

        $this->dispatchBrowserEvent('show-edit-UserStory-modal');
    }

    public function editUserStoryData()
    {
        $this->validate([
            'duration'=>'required|integer|not_in:0',
            // |between:1,10
        ]);

        $pert = UserStory::where('id', $this->id_edit)->first();

        //Add Edit Data
        $pert->at_id = $this->at_id;
        $pert->duration = $this->duration;
        $pert->prio_id = $this->prio_id;
        $pert->sw_id = $this->sw_id;
        $pert->us_budget = $this->us_budget;

        $pert->save();

        session()->flash('message',"บันทึกการแก้ไขข้อมูลเรียบร้อย");

        //hide modal adter add data success
        $this->dispatchBrowserEvent('close-modal');

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //View
    public function viewUserStoryDetails($id){
        // $pert = PERT::where('id', $id)->first();
        $softwares = DB::table('softwares')
        ->where('status', 'กำลังดำเนินการ')->get();
        $act_types = DB::table('base_activity_types')
        ->where('status', 0)->get();
        $priorities = DB::table('base_priorities')
        ->where('status', 0)->get();

        $US = UserStory::join('softwares',
        'softwares.id','=','software_user_stories.sw_id')
        ->join('base_priorities','base_priorities.id','=',
        'software_user_stories.prio_id')
        ->join('base_activity_types','base_activity_types.id','=',
        'software_user_stories.at_id')
        ->where('software_user_stories.id', $id)
        ->select(
        'software_user_stories.user_story_detail as us_name',
        'softwares.id as sw_id',
        'softwares.name as sw_name',
        'base_priorities.name as prio_name',
        'software_user_stories.id as real_us_id',
        'software_user_stories.us_id as fake_us_id',
        'software_user_stories.duration as us_duration',
        'software_user_stories.status as us_status',
        'base_activity_types.status as at_status',
        'base_activity_types.name as at_name',
        'base_activity_types.id as at_id')->first();

        $this->view_sw_name = $US->sw_name;
        $this->view_us_id = $US->real_us_id;
        $this->view_us = $US->us_name;
        $this->view_ust = $US->at_name;
        $this->view_du = $US->us_duration;
        $this->view_priority = $US->prio_name;

        $this->dispatchBrowserEvent('show-view-UserStory-modal');
    }

    public function closeviewUserStoryModal()
    {
        $this->view_sw_name='';
        $this->view_us_id='';
        $this->view_us='';
        $this->view_ust='';
        $this->view_du='';
        $this->view_priority='';
        
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateStatus(Request $request){
        $status = $request->status;
        $id = $request->id;
        UserStory::find($id)->update(['status'=>$status]);

        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
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

    public function getUserStory(Request $request)
    {
        $ust_id = $request->get('ust_id');
        // $user = DB::table('users')->where('name', 'John')->first();

        $pert = DB::table('base_perts')
            ->where('at_id', $ust_id)->first();
            // ->get();
        return $pert;
    }

    public function render()
    {
        // get all data
        $softwares = DB::table('softwares')
        ->where('status', '0')->get();
        $act_types = DB::table('base_activity_types')
        ->where('status', 0)->get();
        $priorities = DB::table('base_priorities')
        ->where('status', 0)->get();
        $US = DB::table('software_user_stories')
        ->join('softwares',
        'softwares.id','=','software_user_stories.sw_id')
        ->join('base_priorities','base_priorities.id','=',
        'software_user_stories.prio_id')
        ->join('base_activity_types','base_activity_types.id','=',
        'software_user_stories.at_id')
        ->paginate(5, array(
        'software_user_stories.user_story_detail as us_name',
        'softwares.id as sw_id',
        'softwares.name as sw_name',
        'base_priorities.name as prio_name',
        'software_user_stories.id as real_us_id',
        'software_user_stories.us_id as fake_us_id',
        'software_user_stories.duration as us_duration',
        'software_user_stories.status as us_status',
        'base_activity_types.status as at_status',
        'base_activity_types.name as at_name',
        'base_activity_types.id as at_id'));

        return view('livewire.s-m-component.software.s-m-user-story-component',
        ['US'=>$US ,'softwares'=>$softwares,'act_types'=>$act_types,'priorities'=>$priorities])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }
}
