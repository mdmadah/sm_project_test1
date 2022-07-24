<?php

namespace App\Http\Controllers;

use App\Models\Base\Company;
use App\Models\Base\Tambon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // public $amphoes,$tambons;
    public function adminindex(){
        $compa = Company::first();
        $provinces = Tambon::select('province')->distinct()->get();
        // $amphoes = Tambon::select('amphoe')->distinct()->get();
        // $tambons = Tambon::select('tambon')->distinct()->get();
        return view('livewire.admin-component.admin-company-component', compact('compa',
        'provinces'
        // ,'amphoes','tambons'
    ));
        // 'users' ,'position','provinces','amphoes','tambons'));
    }

    public function update(Request $request){
        // $status = $request->name_en;
        // $id = $request->name_th;
        Company::first()->update([
            'name_en'=>$request->name_en,
            'name_th'=>$request->name_th,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'no'=>$request->no,
            'mu'=>$request->mu,
            'street'=>$request->street,
            'province'=>$request->province,
            'amphure'=>$request->amphure,
            'district'=>$request->district,
            'postcode'=>$request->postcode]);
        
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

    }
    // sm
    public function smindex(){
        $compa = Company::first();
        $provinces = Tambon::select('province')->distinct()->get();
        // $amphoes = Tambon::select('amphoe')->distinct()->get();
        // $tambons = Tambon::select('tambon')->distinct()->get();
        return view('livewire.s-m-component.base.s-m-company-component', compact('compa',
        'provinces'
        // ,'amphoes','tambons'
         ));
        // 'users' ,'position','provinces','amphoes','tambons'));
    }
}
