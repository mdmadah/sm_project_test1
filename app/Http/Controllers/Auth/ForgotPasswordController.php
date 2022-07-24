<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function showForgotPasswordForm() {
        return view('auth.passwords.reset');
    }
    
    // public function showResetPassword() {
    //     return 
    // }
}
