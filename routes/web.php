<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController as authCtrl;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\PatientController;
/* account */

use App\Http\Controllers\Account\MasterheadController;
use App\Http\Controllers\Account\SubheadController;
use App\Http\Controllers\Account\ChieldheadoneController;
use App\Http\Controllers\Account\ChieldheadtwoController;
use App\Http\Controllers\Account\JournalvoucherController;
use App\Http\Controllers\Account\DebitvoucherController;
use App\Http\Controllers\Account\CreditvoucherController;
    /* donor and fund */
use App\Http\Controllers\Account\DonorvoucherController;

    
/* account report */
use App\Http\Controllers\Account\Report\ProfitLossController;
use App\Http\Controllers\Account\Report\BalanceSheetController;
use App\Http\Controllers\Account\Report\HeadReportController;
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

/*******************Basic Routes Start****************************************/
Route::group(['middleware'=>'UnknownUser'],function(){
    Route::get('/', [authCtrl::class, 'signInForm'])->name('default');
    Route::get('/login', [authCtrl::class, 'signInForm'])->name('login');
    Route::get('/sign-in', [authCtrl::class, 'signInForm'])->name('signin');
    Route::post('/sign-in', [authCtrl::class, 'signIn'])->name('signin.varify');

    Route::get('/sign-up', [authCtrl::class, 'signUpForm'])->name('signup');
    Route::post('/sign-up', [authCtrl::class, 'signUpStore'])->name('signUpStore');

    Route::get('/forget-password', [authCtrl::class, 'forgetForm'])->name('forget');
});

Route::get('/logout', [authCtrl::class, 'logout'])->name('logout');

/* superadmin group */
Route::group(['middleware'=>'isSuperadmin'],function(){
    Route::prefix('superadmin')->group(function(){
        
        Route::get('/dashboard', [DashboardController::class, 'superadmin'])->name('superadmin.dashboard');
        Route::resource('users', UserController::class);

        /* settings */
        Route::resource('patient', PatientController::class, ['names' => 'superadmin.patient']);
        
        Route::resource('journal', JournalvoucherController::class, ['names' => 'superadmin.journal']);
        Route::get('/get_head', [JournalvoucherController::class, 'get_head'])->name('superadmin.get_head');
        
        Route::resource('debit_voucher', DebitvoucherController::class, ['names' => 'superadmin.drvoucher']);
        Route::get('/debit_get_head', [DebitvoucherController::class, 'get_head'])->name('superadmin.debit_get_head');
        
        Route::resource('credit_voucher', CreditvoucherController::class, ['names' => 'superadmin.crvoucher']);
        Route::get('/credit_get_head', [CreditvoucherController::class, 'get_head'])->name('superadmin.credit_get_head');
        
        Route::resource('donor_voucher', DonorvoucherController::class, ['names' => 'superadmin.donorvoucher']);
        Route::get('/donor_get_head', [DonorvoucherController::class, 'get_head'])->name('superadmin.donor_get_head');
        
        Route::get('/profitloss', [ProfitLossController::class, 'index'])->name('superadmin.profitloss');
        Route::get('/balancesheet', [BalanceSheetController::class, 'index'])->name('superadmin.balancesheet');
        Route::get('/headreport', [HeadReportController::class, 'index'])->name('superadmin.headreport');
        
        
        Route::resource('masterhead', MasterheadController::class);
        Route::resource('subhead', SubheadController::class);
        Route::resource('chieldone', ChieldheadoneController::class);
        Route::resource('chieldtwo', ChieldheadtwoController::class);
    });
});

/* admin group */
Route::group(['middleware'=>'isAdmin'],function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    });
});

/* user group */
Route::group(['middleware'=>'isUser'],function(){
    Route::prefix('user')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    });
});

/*******************Basic Routes Ends****************************************/