<?php

namespace App\Http\Livewire\SMComponent\Report;

use App\Models\Software\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SMFinalReportComponent extends Component
{
    public $name, $id_edit, $owner_id, $sm_id, $duration;
    public $allBudget, $expectedBudget, $signDate, $startDate, $endDate;
    public $selectedSw = null;
    public $print = 'null';

    public function getReport(Request $request){
        $input_sw = $request->get('input_sw');

        $report = Software::join('users as owner',
        'softwares.owner_id','=','owner.id')
        ->join('users as sms','softwares.sm_id','=','sms.id')
        ->select('softwares.id as sw_id',
        'softwares.name as sw_name',
        'softwares.status as sw_status',
        'owner.firstname as ow_firstname',
        'owner.lastname as ow_lastname',
        'sms.firstname as sm_firstname',
        'sms.lastname as sm_lastname',
        'softwares.signDate as signDate',
        'softwares.startDate as startDate',
        'softwares.endDate as endDate',
        'softwares.duration as duration',
        'softwares.usedBudget as usedBudget',
        'softwares.expectedBudget as expectedBudget',
        'softwares.allBudget as allBudget')
        ->where('softwares.id', 'like', "%$input_sw%")
        ->get();

        return $report;
    }

    public function render()
    {
        // get all data
        $softwares = DB::table('softwares')
        ->where('status', '1')->get();

        return view('livewire.s-m-component.report.s-m-final-report-component',
        ['softwares'=>$softwares])
        ->layout('livewire.layouts.sm-base');
    }
}