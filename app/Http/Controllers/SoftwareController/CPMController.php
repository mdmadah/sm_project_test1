<?php

namespace App\Http\Controllers\SoftwareController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Software\Accelerate_history;
use App\Models\Software\Activity;
use App\Models\Software\CPM;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Arrays;

class CPMController extends Controller
{
    public function index()
    {
        $softwares = CPM::join(
            'softwares',
            'softwares.id',
            '=',
            'software_cpms.sw_id'
        )
            ->select(
                'software_cpms.sw_id as id',
                'softwares.name as name'
            )
            ->where('softwares.status', 'กำลังดำเนินการ')
            ->where('software_cpms.status', 0)
            ->distinct()->get();

        return view(
            'livewire\s-m-component\software\s-m-c-p-m-component',
            compact('softwares')
        )->with('success',null);
    }

    public function getUST(Request $request)
    {
        $sw_id = $request->get('input_sw');
        $UST = CPM::select(
            'software_user_stories.at_id as ust_id',
            'base_activity_types.name as ust_name'
        )
            ->join(
                'software_user_stories',
                'software_user_stories.id',
                '=',
                'software_cpms.us_id'
            )
            ->join(
                'base_activity_types',
                'base_activity_types.id',
                '=',
                'software_user_stories.at_id'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.status', 0)
            ->distinct()->get();

        return $UST;
    }

    public function getUS(Request $request)
    {
        $sw_id = $request->get('input_sw');
        $ust_id = $request->get('input_ust');
        $US = CPM::select(
            'software_user_stories.id as us_id',
            'software_user_stories.user_story_detail as us_name'
        )
            ->join(
                'software_user_stories',
                'software_user_stories.id',
                '=',
                'software_cpms.us_id'
            )
            ->join(
                'base_activity_types',
                'base_activity_types.id',
                '=',
                'software_user_stories.at_id'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('base_activity_types.id', $ust_id)
            ->where('software_cpms.status', 0)
            ->distinct()->get();

        return $US;
    }

    public function getActivity(Request $request)
    {
        $sw_id = $request->get('input_sw');
        $us_id = $request->get('input_us');
        $Act = CPM::select(
            'software_cpms.sw_id as sw_id',
            'software_user_stories.us_id as us_id',
            'software_cpms.f_act_id as act_id',
            'software_activities.name as act_name',
            'software_cpms.f_pre_id as pre_id'
        )
            ->join(
                'softwares',
                'softwares.id',
                '=',
                'software_cpms.sw_id'
            )
            ->join(
                'software_user_stories',
                'software_user_stories.id',
                '=',
                'software_cpms.us_id'
            )
            ->join(
                'software_activities',
                'software_activities.id',
                '=',
                'software_cpms.act_id'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.status', 0)
            ->distinct()->get();

        return $Act;
    }

    public function calculate(Request $request)
    {
        $sw_id = $request->get('input_sw');
        $us_id = $request->get('input_us');

        $Actdetail = CPM::select(
            'software_cpms.act_id as act_id',
            'software_activities.ac_id as f_act_id',
            'software_activities.NT as NT',
            'software_activities.rush_day as rush_day',
            'software_activities.rush_cost_per_day as rush_cost'
        )
            ->join(
                'software_activities',
                'software_activities.id',
                '=',
                'software_cpms.act_id'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.status', 0)
            ->get();

        // Update data required for calculations
        foreach ($Actdetail as $unit) {
            CPM::where('act_id', $unit['act_id'])
                ->where('pre_id', null)
                ->update([
                    'f_act_id' => $unit['f_act_id'],
                    'duration' => $unit['NT'],
                    'EF' => $unit['NT'],
                    'rush_day' => $unit['rush_day'],
                    'rush_cost' => $unit['rush_cost']
                ]);

            foreach ($Actdetail as $pre_unit) {

                CPM::where('act_id', $unit['act_id'])
                    ->where('pre_id', $pre_unit['act_id'])
                    ->update([
                        'f_act_id' => $unit['f_act_id'],
                        'f_pre_id' => $pre_unit['f_act_id'],
                        'duration' => $unit['NT'],
                        'rush_day' => $unit['rush_day'],
                        'rush_cost' => $unit['rush_cost']
                    ]);
            }
        }

        // Calaulate ES,EF
        $PreEF = CPM::select(
            'software_cpms.act_id as act_id',
            'software_cpms.EF as EF'
        )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.pre_id', null)
            ->where('software_cpms.status', 0)
            ->get()->toArray();

        for ($p = 0; $p < count($PreEF); $p++) {
            $Next = CPM::select(
                'software_cpms.act_id as act_id',
                'software_cpms.duration as duration',
                'software_cpms.ES as ES'
            )
                ->where('software_cpms.sw_id', $sw_id)
                ->where('software_cpms.us_id', $us_id)
                ->where('software_cpms.pre_id', $PreEF[$p]['act_id'])
                ->where('software_cpms.status', 0)
                ->get();
            for ($n = 0; $n < count($Next); $n++) {
                if ($Next[$n]->ES < $PreEF[$p]['EF']) {
                    CPM::where('act_id', $Next[$n]->act_id)
                        ->update([
                            'ES' => $PreEF[$p]['EF'],
                            'EF' => (int)$PreEF[$p]['EF'] + (int)$Next[$n]->duration
                        ]);
                    $newPre = [
                        'act_id' => $Next[$n]->act_id,
                        'EF' => (int)$PreEF[$p]['EF'] + (int)$Next[$n]->duration
                    ];
                    array_push($PreEF, $newPre);
                }
            }
        }




        // Calaulate LS, LF,SL
        $LastAct = DB::table('software_cpms')
            ->select('software_cpms.act_id', 'software_cpms.ES', 'software_cpms.EF')
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.status', 0)
            ->where('software_cpms.EF', DB::table('software_cpms')->max('EF'))
            ->first();

        CPM::where('act_id', $LastAct->act_id)
            ->update([
                'LS' => $LastAct->ES,
                'LF' => $LastAct->EF,
                'SL' => 0
            ]);

        $Last = DB::table('software_cpms')
            ->select(
                'software_cpms.act_id',
                'software_cpms.pre_id',
                'software_cpms.LS'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.status', 0)
            ->where('software_cpms.EF', DB::table('software_cpms')->max('EF'))
            ->get();


        // $newPre = new CPM();
        // $newPre->act_id = 3;
        // $newPre->EF = 33;

        // array_push($PreEF, $casts);
        $Last = json_decode($Last,true);

        for ($l = 0; $l < count($Last); $l++) {
            // if ($l == 2) {$l+2;}
                # code...
                $PreAct = CPM::select(
                'software_cpms.act_id',
                'software_cpms.pre_id',
                'software_cpms.duration',
                'software_cpms.LF',
                'software_cpms.ES'
                )
                ->where('software_cpms.sw_id', $sw_id)
                ->where('software_cpms.us_id', $us_id)
                ->where('software_cpms.act_id', $Last[$l]['pre_id'])
                ->where('software_cpms.status', 0)
                ->get();
                $PreAct = json_decode($PreAct,true);
                

                for ($a = 0; $a < count($PreAct); $a++) {
                    if ((int)$PreAct[$a]['LF'] > (int)$Last[$l]['LS']) {

                        CPM::where('act_id', $PreAct[$a]['act_id'])
                            ->update([
                                'LF' => (int)$Last[$l]['LS'],
                                'LS' => (int)$Last[$l]['LS'] - (int)$PreAct[$a]['duration'],
                                'SL' => (int)$Last[$l]['LS'] - (int)$PreAct[$a]['duration'] - (int)$PreAct[$a]['ES']
                            ]);

                        if ($PreAct[$a]['pre_id'] != null) {
                            $newLast = [
                                'act_id' => $PreAct[$a]['act_id'],
                                'pre_id' => $PreAct[$a]['pre_id'],
                                'LS' => (int)$Last[$l]['LS'] - (int)$PreAct[$a]['duration']
                            ];
                            
                            array_push($Last, $newLast);
                    }
                }
            }
            
            

            

        }

        $cpm = CPM::join('software_activities',
        'software_activities.id','=','software_cpms.act_id')
        ->select(
            'software_cpms.act_id',
            'software_cpms.f_act_id',
            'software_cpms.us_id',
            'software_cpms.sw_id',
            'software_activities.name',
            'software_cpms.rush_day',
            'software_cpms.rush_cost'
            )
            ->where('software_cpms.sw_id', $sw_id)
            ->where('software_cpms.us_id', $us_id)
            ->where('software_cpms.SL',0)
            ->distinct()->get();
        

        return $cpm;
    }

    public function accelerate(Request $request)
    {
        $id = $request->get('id');
        $days = $request->get('day2');
        $sw_id = $request->get('sw_id');
        $us_id = $request->get('us_id');

        for ($i=0; $i < count($days); $i++) {
            // remaining day
            $r_day = (DB::table('software_activities')
            ->where('id', $id[$i])
            ->where('sw_id',$sw_id)
            ->where('us_id',$us_id)->value('rush_day'))
            - $days[$i];

            // update activity's rush day
            Activity::where('id', $id[$i])
            ->where('sw_id',$sw_id)
            ->where('us_id',$us_id)
            ->update([
                'rush_day' => $r_day]);

            // record to Accelerate_history
            if ($days[$i]!=0) {
                $insert = new Accelerate_history();
                $insert->sw_id = $sw_id;
                $insert->us_id = $us_id;
                $insert->act_id = $id[$i];
                $insert->rush_day = $days[$i];
                $insert->save();
            }
            
        }

        // recall this index function (manual)
        $softwares = CPM::join(
            'softwares','softwares.id','=','software_cpms.sw_id'
        )->select('software_cpms.sw_id as id','softwares.name as name'
        )->where('softwares.status', 'กำลังดำเนินการ')
        ->where('software_cpms.status', 0)
        ->distinct()->get();

        // Alert::success('Congrats', 'You\'ve Successfully Registered');
        // alert()->success('Title','Lorem Lorem Lorem');

        return view(
            'livewire\s-m-component\software\s-m-c-p-m-component',
            compact('softwares')
        )->with('success',"บันทึกข้อมูลเรียบร้อย");

    }
}
