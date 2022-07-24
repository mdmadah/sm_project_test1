<?php

namespace App\Http\Livewire\SMComponent\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SMEmployeeComponent extends Component
{
    public function render()
    {
        $nametitle = DB::table('base_name_titles')
        ->where('status', 1)->get();
        $position = DB::table('base_positions')
        ->where('status', 1)->get();
        // $users = User::paginate(10);

        $users = User::join('user_employee_details','users.id','=',
        'user_employee_details.user_id')
        ->join('base_positions','base_positions.id','=',
        'user_employee_details.position_id')
        ->where('users.role', '!=','4')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'base_positions.name as position',
        'users.id as id',
        'users.status'));

        // $provinces = Address_province::select('id','name_th')->distinct()->orderBy('name_th')->get();
        // $amphoes = Address_amphure::select('id','name_th')->distinct()->orderBy('name_th')->get();
        // $tambons = Address_district::select('id','name_th')->distinct()->orderBy('name_th')->get();

        return view('livewire.s-m-component.users.s-m-employee-component'
        ,['nametitle'=>$nametitle, 'position'=>$position, 'users'=>$users])
        ->with('i',(request()->input('page',1)-1)*5)
        ->layout('livewire.layouts.sm-base');
    }
}
