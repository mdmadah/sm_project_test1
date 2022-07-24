<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_employee_detail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected function redirectTo(){
        if( Auth()->user()->role == 1 ){
            return route('admin.dashboard');
        }
        elseif( Auth()->user()->role == 2 ){
            return route('sm.dashboard');
        }
        elseif( Auth()->user()->role == 3 ){
            return route('ts.dashboard');
        }
        elseif( Auth()->user()->role == 4 ){
            return route('owner.dashboard');
        }
    }

/**
 * Create a new controller instance.
 *
 * @return void
 */

public function __construct()
{
    $this->middleware('guest')->except('logout');
}
    public function Login(Request $request){
        $input = $request->all();   
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if( auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password'])) ){
            $request->session()->put('email',$input['email']);
            $request->session()->put('role',auth()->user()->role);
            $request->session()->put('id_user',auth()->user()->id);

            if( auth()->user()->role == 1 ){
                return redirect()->route('admin.dashboard');
            }
            elseif( auth()->user()->role == 2 ){
                return redirect()->route('sm.dashboard');
            }
            elseif( auth()->user()->role == 3 ){
                
                // session('id_user')
                $position = User_employee_detail::Where('user_employee_details.user_id',session('id_user'))
                ->join('base_positions','base_positions.id','=',
                'user_employee_details.position_id')->first();
                
                $request->session()->put('position', $position->name);
                return redirect()->route('ts.dashboard');
            }
            elseif( auth()->user()->role == 4 ){
                return redirect()->route('owner.dashboard');
            }
        }else{
            return view('/auth/login')->with('error','Email or password are wrong');
        }
    }

    public function LoginforUser(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        // return auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']));
        if( auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password'])) ){

            if( auth()->user()->role == 1 ){
                $request->session()->put('LoggedUser', auth()->user()->id);
                
                $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
                dd($data);
                return redirect()->route('admin.dashboard', $data);
            }
            elseif( auth()->user()->role == 2 ){
                $request->session()->put('LoggedUser', auth()->user()->id);
                return redirect()->route('sm.dashboard');
            }
            elseif( auth()->user()->role == 3 ){
                $request->session()->put('LoggedUser', auth()->user()->id);
                return redirect()->route('ts.dashboard');
            }
            elseif( auth()->user()->role == 4 ){
                $request->session()->put('LoggedUser', auth()->user()->id);
                return redirect()->route('owner.dashboard');
            }
        }else{
            return redirect()->route('LoginUser')->with('error','Email or password are wrong');
        }
        
    }

    public function dashboard(){
        $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUser'))->first()];
        return view('admin_page.admin_index', $data);
    }

}



