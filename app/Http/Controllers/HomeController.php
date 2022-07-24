<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        
        if(session()->has('email')){
            // return redirect('')
            
            
            if( session()->get('role', 'default') == 1 ){
                return redirect()->route('admin.dashboard');
            }
            elseif( session()->get('role', 'default') == 2 ){
                return redirect()->route('sm.dashboard');
            }
            elseif( session()->get('role', 'default') == 3 ){

                return redirect()->route('ts.dashboard');
            }
            elseif( session()->get('role', 'default') == 4 ){
                
                return redirect()->route('owner.dashboard');
            }
        }
        // else{
            return view('/auth/login');
        // }
        // 
    }
}
