<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Base\Tambon;
use App\Models\User;
use App\Models\User_owner_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserOwnerController extends Controller
{
    public function adminindex(){
        $nametitle = DB::table('base_name_titles')
        ->where('status', 1)->get();
        $position = DB::table('base_positions')
        ->where('status', 1)->get();
        
        $users = User::join('user_owner_details','users.id','=',
        'user_owner_details.user_id')
        ->where('users.role', '=','4')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'user_owner_details.organ_name_en as organ_name',
        'users.id as id',
        'users.status'));

        $provinces = Tambon::select('province')->distinct()->get();
        $amphoes = Tambon::select('amphoe')->distinct()->get();
        $tambons = Tambon::select('tambon')->distinct()->get();
        return view('livewire.admin-component.admin-owner-component', 
        compact('nametitle','position','provinces','amphoes',
        'tambons','users'))
        ->with('i',(request()->input('page',1)-1)*5);
    }
    // owner
    public function dashboard(){
        
        return view('owner_page.owner_index');
    }
    
    public function update(Request $request){
        $status = $request->status;
        $id = $request->id;
        User::find($id)->update(['status'=>$status]);

        // $name_title = Base_name_title::find($id);
        // $name_title->status = $request->status;
        // $name_title->save();
        return response()->json([
            'status' => 200,
            'message'=>'Success',
        ], 200);
    }


    public function adminstore(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'firstname'=>'required|unique:users|max:30',
        //     'lastname'=>'required|unique:users|max:30',

        //     'phone'=>'required|unique:users|max:10',
        //     // email
        //     // password

        // ]
        // ,[
        //     'firstname.required'=>"*กรุณาป้อนชื่อ",
        //     'firstname.unique'=>"*มีชื่อนี้แล้ว",
        //     'firstname.max'=>"*ชื่อไม่ควรเกิน 30 ตัวอักษร",

        //     'lastname.required'=>"*กรุณาป้อนนามสกุล",
        //     'lastname.unique'=>"*มีนามสกุลนี้แล้ว",
        //     'lastname.max'=>"*นามสกุลไม่ควรเกิน 30 ตัวอักษร",

        //     'phone.required'=>"*กรุณาป้อนเบอร์โทรศัพท์",
        //     'phone.unique'=>"*มีเบอร์โทรศัพท์นี้แล้ว",
        //     'phone.max'=>"*เบอร์โทรศัพท์ไม่ควรเกิน 10 ตัวอักษร",

        // ]);
        $user = new User();
                $user->nt_id = $request->nt_id;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->phone = $request->phone;
                $user->email = $request->email;
                // $user->position_id = $request->position_id;
                $user->password = Hash::make($request->password);
                $user->role = 4;
                $user->save();

                $detail = new User_owner_detail();                    
                $detail->organ_name_en = $request->organ_name_en;
                $detail->organ_name_th = $request->organ_name_th;
                $detail->organ_phone = $request->organ_phone;

                $detail->organ_no = $request->no;
                $detail->organ_mu = $request->mu;
                $detail->organ_street = $request->street;
                $detail->organ_province = $request->province;
                $detail->organ_amphure = $request->amphure;
                $detail->organ_district = $request->district; 
                $detail->organ_postcode = $request->postcode;
                
                $user->owner_detail()->save($detail);

            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function getOwnerData(Request $request){

        $owner = User::join('user_owner_details','users.id','=',
        'user_owner_details.user_id')
        ->join('base_name_titles','users.nt_id','=','base_name_titles.id')
        ->where('users.id', '=',$request->get('ow_id'))
        ->select('user_owner_details.organ_name_en as organ_name_en',
        'user_owner_details.organ_name_th as organ_name_th',
        'base_name_titles.name as name_title',
        'users.firstname as firstname',
        'users.lastname as lastname',
        'user_owner_details.organ_phone as organ_phone',
        'users.phone as phone',
        'user_owner_details.organ_no as organ_no',
        'user_owner_details.organ_mu as organ_mu',
        'user_owner_details.organ_street as organ_street',
        'user_owner_details.organ_province as organ_province',
        'user_owner_details.organ_amphure as organ_amphure',
        'user_owner_details.organ_district as organ_district',
        'user_owner_details.organ_postcode as organ_postcode',
        'users.id as id',
        'users.email as email',
        // 'users.password as password'
        )->get();

        // dd($owner);
        return $owner;
    }

    public function adminedit(Request $request){

        $user = new User();
                $user->nt_id = $request->nt_id;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->phone = $request->phone;
                $user->email = $request->email;
                // $user->position_id = $request->position_id;
                $user->password = Hash::make($request->password);
                $user->role = 4;
                $user->save();

                $detail = new User_owner_detail();                    
                $detail->organ_name_en = $request->organ_name_en;
                $detail->organ_name_th = $request->organ_name_th;
                $detail->organ_phone = $request->organ_phone;

                $detail->organ_no = $request->no;
                $detail->organ_mu = $request->mu;
                $detail->organ_street = $request->street;
                $detail->organ_province = $request->province;
                $detail->organ_amphure = $request->amphure;
                $detail->organ_district = $request->district; 
                $detail->organ_postcode = $request->postcode;
                
                $user->owner_detail()->save($detail);

        return redirect()->back()->with('success',"แก้ไขข้อมูลเรียบร้อย");
    }

    // sm
    public function smindex(){
        $nametitle = DB::table('base_name_titles')
        ->where('status', 1)->get();
        $position = DB::table('base_positions')
        ->where('status', 1)->get();
        
        $users = User::join('user_owner_details','users.id','=',
        'user_owner_details.user_id')
        ->where('users.role', '=','4')
        ->paginate(5, array('users.lastname as lastname',
        'users.firstname as firstname',
        'users.phone as phone',
        'user_owner_details.organ_name_en as organ_name',
        'users.id as id',
        'users.status'));

        $provinces = Tambon::select('province')->distinct()->get();
        $amphoes = Tambon::select('amphoe')->distinct()->get();
        $tambons = Tambon::select('tambon')->distinct()->get();
        return view('sm_page.sm_users.sm_owner', 
        compact('nametitle','position','provinces','amphoes',
        'tambons','users'))
        ->with('i',(request()->input('page',1)-1)*5);
    }


    public function smstore(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'firstname'=>'required|unique:users|max:30',
        //     'lastname'=>'required|unique:users|max:30',

        //     'phone'=>'required|unique:users|max:10',
        //     // email
        //     // password

        // ]
        // ,[
        //     'firstname.required'=>"*กรุณาป้อนชื่อ",
        //     'firstname.unique'=>"*มีชื่อนี้แล้ว",
        //     'firstname.max'=>"*ชื่อไม่ควรเกิน 30 ตัวอักษร",

        //     'lastname.required'=>"*กรุณาป้อนนามสกุล",
        //     'lastname.unique'=>"*มีนามสกุลนี้แล้ว",
        //     'lastname.max'=>"*นามสกุลไม่ควรเกิน 30 ตัวอักษร",

        //     'phone.required'=>"*กรุณาป้อนเบอร์โทรศัพท์",
        //     'phone.unique'=>"*มีเบอร์โทรศัพท์นี้แล้ว",
        //     'phone.max'=>"*เบอร์โทรศัพท์ไม่ควรเกิน 10 ตัวอักษร",

        // ]);
        $user = new User();
                $user->nt_id = $request->nt_id;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->phone = $request->phone;
                $user->email = $request->email;
                // $user->position_id = $request->position_id;
                $user->password = Hash::make($request->password);
                $user->role = 4;
                $user->save();

                $detail = new User_owner_detail();                    
                $detail->organ_name_en = $request->organ_name_en;
                $detail->organ_name_th = $request->organ_name_th;
                $detail->organ_phone = $request->organ_phone;

                $detail->organ_no = $request->no;
                $detail->organ_mu = $request->mu;
                $detail->organ_street = $request->street;
                $detail->organ_province = $request->province;
                $detail->organ_amphure = $request->amphure;
                $detail->organ_district = $request->district; 
                $detail->organ_postcode = $request->postcode;
                
                $user->owner_detail()->save($detail);

            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
}
