<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoftwareController\CPMController;
use App\Http\Controllers\SoftwareController\OrderController;
use App\Http\Controllers\Users\UserEmployeeController;
use App\Http\Controllers\Users\UserOwnerController;
use App\Http\Livewire\AdminComponent\AdminAddressComponent;
use App\Http\Livewire\AdminComponent\AdminCompanyComponent;
use App\Http\Livewire\AdminComponent\AdminEmployeeComponent;
use App\Http\Livewire\AdminComponent\AdminNameTitleComponent;
use App\Http\Livewire\AdminComponent\AdminOwnerComponent;
use App\Http\Livewire\AdminComponent\AdminPERTComponent;
use App\Http\Livewire\AdminComponent\AdminPositionComponent;
use App\Http\Livewire\AdminComponent\AdminPriorityComponent;
use App\Http\Livewire\AdminComponent\AdminUserStoryTypeComponent;
use App\Http\Livewire\OwnerComponent\OwnerUserStory;
use App\Http\Livewire\SMComponent\Base\SMAddressComponent;
use App\Http\Livewire\SMComponent\Base\SMCompanyComponent;
use App\Http\Livewire\SMComponent\Base\SMNameTitleComponent;
use App\Http\Livewire\SMComponent\Base\SMPERTComponent;
use App\Http\Livewire\SMComponent\Base\SMPositionComponent;
use App\Http\Livewire\SMComponent\Base\SMPriorityComponent;
use App\Http\Livewire\SMComponent\Base\SMUserStoryTypeComponent;
use App\Http\Livewire\SMComponent\Report\SMFinalReportComponent;
use App\Http\Livewire\SMComponent\Report\SMSoftwareProgressComponent;
use App\Http\Livewire\SMComponent\Report\SMTeamPerformaceComponent;
use App\Http\Livewire\SMComponent\Software\SMActivityComponent;
use App\Http\Livewire\SMComponent\Software\SMSoftwareComponent;
use App\Http\Livewire\SMComponent\Software\SMUserStoryComponent;
use App\Http\Livewire\SMComponent\Users\SMEmployeeComponent;
use App\Http\Livewire\SMComponent\Users\SMOwnerComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('LoginPage');

Route::post('/logoutform', function () {
    session()->forget(['email', 'role', 'id_user', 'position']);
    return view('welcome');
})->name('logoutform');

Route::post('/loginform', [LoginController::class,'Login'])->name('Login');
Route::get('/home', [HomeController::class, 'login'])->name('home');

Route::get('/password/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/password/forgot', [ForgotPasswordController::class, 'sendReset'])->name('forgot.password.send');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('reset.password');

// Admin
Route::group(['prefix'=>'admin'],function() {
    // 'middleware' =>['auth']], function() {
        Route::get('/', function () {
            return view('livewire.admin-component.admin-index');
        })->name('admin.dashboard');
        
        // Base
        Route::get('/base/nametitle', AdminNameTitleComponent::class)->name('admin.nametitle');
        Route::get('/address', AdminAddressComponent::class)->name('admin.Address');
        Route::get('/position', AdminPositionComponent::class)->name('admin.Position');
        Route::get('/priority', AdminPriorityComponent::class)->name('admin.Priority');
        Route::get('/pert', AdminPERTComponent::class)->name('admin.Pert');
        Route::get('/user-story-type', AdminUserStoryTypeComponent::class)->name('admin.UStype');
        Route::get('/company', [CompanyController::class,'adminindex'])->name('admin.Company');
        Route::post('/company/add', [CompanyController::class,'update'])->name('addCompany');

        // User
    Route::get('/user', AdminEmployeeComponent::class)->name('admin.User');
    
    // // Owner
    //     Route::get('/owner', [UserOwnerController::class,'adminindex'])->name('admin.Owner');
    //     Route::post('/owner/add', [UserOwnerController::class,'adminstore'])->name('admin.addOwner');
    //     Route::post('/owner/edit', [UserOwnerController::class,'adminedit'])->name('admin.editOwner');
    
        // Route::post('/user/add', [UserEmployeeController::class,'adminstore'])->name('admin.addUser');
        // Route::get('/user', AdminEmployeeComponent::class)->name('admin.User');
        Route::get('/owner', AdminOwnerComponent::class)->name('admin.Owner');

        
});
// End Admin

// SM
Route::group(['prefix'=>'sm'],function() {
    // 'middleware' =>['auth']], function() {
        Route::get('/', function () {
            return view('livewire.s-m-component.s-mindex');
        })->name('sm.dashboard');

        // Base
        Route::get('/base/nametitle', SMNameTitleComponent::class)->name('sm.nametitle');
        Route::get('/address', SMAddressComponent::class)->name('sm.Address');
        Route::get('/position', SMPositionComponent::class)->name('sm.Position');
        Route::get('/user-story-type', SMUserStoryTypeComponent::class)->name('sm.UStype');
        Route::get('/priority', SMPriorityComponent::class)->name('sm.Priority');
        Route::get('/pert', SMPERTComponent::class)->name('sm.Pert');
        Route::get('/company', [CompanyController::class,'smindex'])->name('sm.Company');
        Route::post('/company/add', [CompanyController::class,'update'])->name('addCompany');

        // User
        Route::get('/user', SMEmployeeComponent::class)->name('sm.User');
        Route::get('/owner', SMOwnerComponent::class)->name('sm.Owner');
    
        // software
        Route::get('/software/software', SMSoftwareComponent::class)->name('sm.Software');
        Route::get('/software/user_story', SMUserStoryComponent::class)->name('sm.US');
    
        // Route::get('/software/user_story', [UserStoryController::class,'smindex'])->name('sm.US');
    
        Route::get('/software/activity', SMActivityComponent::class)->name('sm.Act');
    
        // Route::get('/software/activity_order', [ActivityController::class,'smindexorder'])->name('sm.ActOrder');
        // Route::post('/activity_order/add', [ActivityController::class,'smstoreorder'])->name('sm.storeorder');
        // Route::get('/software/add_activity', [ActivityController::class,'smindex_add'])->name('sm.gotoadd_Act');

        Route::get('/software/activity_order', [OrderController::class,'smindexorder'])->name('sm.ActOrder');
        Route::post('/activity_order/add', [OrderController::class,'smstoreorder'])->name('sm.storeorder');

        // sm.cpm
        Route::get('/software/cpm', [CPMController::class,'index'])->name('sm.CPM');
        Route::post('/software/accelerate', [CPMController::class,'accelerate'])->name('AccelerateProject');
        
        // report
        Route::get('/report/final_report', SMFinalReportComponent::class)->name('sm.FinalReport');
        Route::get('/report/team_performance', SMTeamPerformaceComponent::class)->name('sm.team_performance');
        Route::get('/report/software_progress', SMSoftwareProgressComponent::class)->name('sm.software_progress');
});
// End SM

// TS
Route::group(['prefix'=>'ts'],function() {
    // 'middleware' =>['auth']], function() {
        Route::get('/', function () {
            return view('livewire.t-s-component.t-sindex');
        })->name('ts.dashboard');
});
// End TS

// Owner
Route::group(['prefix'=>'owner'],function() {
    // 'middleware' =>['auth']], function() {
        Route::get('/', function () {
            return view('livewire.owner-component.owner-index');
        })->name('owner.dashboard');

        Route::get('/user_story', OwnerUserStory::class)->name('owner.user_story');
});
// End Owner
