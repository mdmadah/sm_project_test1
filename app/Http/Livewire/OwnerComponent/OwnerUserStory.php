<?php

namespace App\Http\Livewire\OwnerComponent;

use App\Models\Software\UserStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OwnerUserStory extends Component
{
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
        
        return view('livewire.owner-component.owner-user-story',
        ['US'=>$US])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.owner-base');
    }
}
