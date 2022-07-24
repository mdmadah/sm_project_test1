<?php

namespace App\Http\Controllers\SoftwareController;

use App\Http\Controllers\Controller;
use App\Models\Software\Activity;
use App\Models\Software\Software;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function getUS(Request $request)
    {
        // $ust_id = $request->get('ust_id');
        // $user = DB::table('users')->where('name', 'John')->first();
        $input_sw = $request->get('input_sw');
        $input_ust = $request->get('input_ust');


        $US = Software::join('software_user_stories','softwares.id','=',
        'software_user_stories.sw_id')
        ->select('software_user_stories.user_story_detail as us_name',
        'software_user_stories.id as us_id')
        ->where('software_user_stories.sw_id', $input_sw)
        ->where('software_user_stories.at_id', $input_ust)
        ->get();
        return $US;
    }

    public function getActivity(Request $request){
        $input_us = $request->get('input_us');

        $Act = Activity::join('software_user_stories','software_user_stories.id','=',
        'software_activities.us_id')
        ->join('softwares','softwares.id','=',
        'software_user_stories.sw_id')
        ->select('software_activities.name as act_name',
        'software_activities.id as act_id',
        'software_activities.ac_id as fake_act_id',
        'softwares.id as sw_id',
        'software_user_stories.us_id as fake_us_id')
        ->where('software_activities.us_id', $input_us)
        ->get();
        return $Act;

    }

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

    public function getOwnerName(Request $request){
        $input_sw = $request->get('input_sw');

        $OwnerName = Activity::join(
        'software_user_stories','software_user_stories.id','=',
        'software_activities.us_id')
        ->join('softwares','softwares.id','=',
        'software_user_stories.sw_id')
        ->join('users','users.id','=',
        'softwares.owner_id')
        ->select('users.firstname as owner_firstname',
        'users.lastname as owner_lastname')
        ->where('softwares.id', 'like', "%$input_sw%")
        ->distinct()
        ->get();
        return $OwnerName;
    }
}
