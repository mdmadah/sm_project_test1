<?php

namespace App\Http\Controllers\SoftwareController;

use App\Http\Controllers\Controller;
use App\Models\Software\Activity;
use App\Models\Software\CPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function smindexorder(){
        $softwares = DB::table('softwares')
        ->where('status', 'กำลังดำเนินการ')->get();
                
        return view('livewire\s-m-component\software\s-m-activity-order-component', 
        compact('softwares'));
    }
    
    public function smstoreorder(Request $request){
        $sw_id = $request->sw_id;
        $us_id = $request->us_id;
        $act_unit = $request->act_unit;
        $pre_unit = $request->pre_unit;

        //select all new order for check order
        DB::table('software_cpms')
        ->where('sw_id',$sw_id)
        ->where('us_id', $us_id)
        ->delete();
        
        //insert order to Software_cpms
            for($i = 0; $i < count($pre_unit); $i++){
                
                for($j = 0; $j < count($pre_unit[$i]); $j++){
                    // dd($act_unit[$i][$j]);
                    $inserted = new CPM();
                    $inserted->sw_id = $sw_id;
                    $inserted->us_id = $us_id;
                    $inserted->act_id = $act_unit[$i];
                    $inserted->f_act_id = Activity::
                    where('sw_id',$sw_id)->where('us_id', $us_id)
                    ->where('id', $act_unit[$i])->value('ac_id');
                    
                    if($pre_unit[$i][$j]!=null){
                        $inserted->pre_id = $pre_unit[$i][$j];
                        $inserted->f_pre_id = Activity::
                        where('sw_id',$sw_id)->where('us_id', $us_id)
                        ->where('id', $pre_unit[$i][$j])->value('ac_id');
                    }
                    $inserted->save();
                }
            }
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function getOrder(Request $request){
        $input_sw = $request->get('input_sw');
        $input_us = $request->get('input_us');

        $ordered = CPM::join('software_user_stories','software_user_stories.id','=',
        'software_cpms.us_id')
        ->join('softwares','softwares.id','=',
        'software_cpms.sw_id')
        ->join('software_activities','software_activities.id','=',
        'software_cpms.act_id')
        ->select('software_activities.name as act_name',
        'software_activities.ac_id as fake_act_id',
        'softwares.id as sw_id',
        'software_user_stories.us_id as fake_us_id',
        'software_cpms.us_id as us_id',
        'software_cpms.us_id as us_id',
        'software_cpms.act_id as act_id',
        'software_cpms.pre_id as pre_id',
        'software_cpms.f_pre_id as f_pre_id',
        )
        ->where('software_cpms.sw_id', $input_sw)
        ->where('software_cpms.us_id', $input_us)
        ->where('software_cpms.status', 0)
        ->get();
        return $ordered;
    }
}
