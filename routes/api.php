<?php

use App\Http\Controllers\SoftwareController\ActivityController;
use App\Http\Controllers\SoftwareController\CPMController;
use App\Http\Controllers\SoftwareController\OrderController;
use App\Http\Controllers\Users\UserOwnerController;
use App\Http\Livewire\AdminComponent\AdminAddressComponent;
use App\Http\Livewire\AdminComponent\AdminNameTitleComponent;
use App\Http\Livewire\AdminComponent\AdminPERTComponent;
use App\Http\Livewire\AdminComponent\AdminPositionComponent;
use App\Http\Livewire\AdminComponent\AdminPriorityComponent;
use App\Http\Livewire\AdminComponent\AdminUserStoryTypeComponent;
use App\Http\Livewire\SMComponent\Software\SMActivityComponent;
use App\Http\Livewire\SMComponent\Software\SMSoftwareComponent;
use App\Http\Livewire\SMComponent\Software\SMUserStoryComponent;
use App\Http\Livewire\SMComponent\Users\SMOwnerComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Change Status
Route::post('/updateStatusNameTitle', [AdminNameTitleComponent::class, 'updateStatus'] );
Route::post('/updateStatusAddress', [AdminAddressComponent::class, 'updateStatus'] );
Route::post('/updateStatusUserStoryType', [AdminUserStoryTypeComponent::class, 'updateStatus'] );
Route::post('/updateStatusOwner', [SMOwnerComponent::class, 'updateStatus'] );
// Route::post('/updateStatusEmployee', [EmployeeController::class, 'updateStatus'] );
Route::post('/updateStatusPriority', [AdminPriorityComponent::class, 'updateStatus'] );
Route::post('/updateStatusPert', [AdminPERTComponent::class, 'updateStatus'] );
Route::post('/updateStatusPosition', [AdminPositionComponent::class, 'updateStatus'] );
Route::post('/updateStatusSoftware', [SMSoftwareComponent::class, 'updateStatus'] );
Route::post('/updateStatusUserStory', [SMUserStoryComponent::class, 'updateStatus'] );

// Address
Route::get('/getAmphoes', [AdminAddressComponent::class, 'getAmphoes'] );
Route::get('/getDistricts', [AdminAddressComponent::class, 'getDistricts'] );
Route::get('/getZipcodes', [AdminAddressComponent::class, 'getZipcodes'] );

// Order & CPM
Route::get('/cpm/USType', [ CPMController::class , 'getUST' ]);
Route::get('/cpm/Act', [ CPMController::class , 'getActivity' ]);
Route::get('/cpm/cal', [ CPMController::class , 'calculate' ]);
Route::get('/cpm/US', [ CPMController::class , 'getUS' ]);

Route::get('/US', [ ActivityController::class , 'getUS' ]);
Route::get('/Act', [ ActivityController::class , 'getActivity' ]); //use on order page
Route::get('/getOrder', [ OrderController::class , 'getOrder' ]);
Route::get('/sw/USType', [ ActivityController::class , 'getUST' ]);
Route::get('/ownerName', [ ActivityController::class , 'getOwnerName' ]);


// Route::get('/USType', [ SMUserStoryComponent::class , 'getUserStory' ]);


// // ของหน้า SMActivityComponent
Route::get('/company', [ SMActivityComponent::class , 'getCompany' ]);
Route::get('/finalreport', [ SMFinalReportComponent::class , 'getReport' ]);
// Route::get('/sw/USType', [ SMActivityComponent::class , 'getUST' ]);
// Route::get('/US', [ SMActivityComponent::class , 'getUS' ]);
// Route::get('/team', [ SMActivityComponent::class , 'getteam' ]);

// // Users
// Route::get('/userOwner', [ UserOwnerController::class , 'getOwnerData' ]);
