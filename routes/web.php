<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupportCostumerController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\NotificationController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::view('/test', 'test');
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile/index', 'profile.index')->name('profile');
    Route::view('/wallet/accno', 'wallet.accno')->name('wallet.acc');


        // https://akth.gov.ng/register/
    Route::post('notifications/{id}/read', [NotificationController::class,'markRead'])->name('notifications.read');
    Route::post('notifications/read-all', [NotificationController::class,'markAllRead'])->name('notifications.readAll');
    Route::get('notifications/index', [NotificationController::class,'index'])->name('notifications.index');
    Route::get('notifications/show/{id}', [NotificationController::class,'show'])->name('notifications.show');

    // Route::view('/transactions/index', 'index')->name('transactions.index');
    Route::get('/transactions/index', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/support/index', [SupportCostumerController::class, 'index'])->name('support.index');
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});


Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');


    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index' ])->name('admin.dashboard');

    // Admin User Management - View All Users
    Route::get('/admin/user/viewUser', [AdminUserController::class, 'view'])->name('viewUser');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('User.edit');
    Route::PATCH('/admin/users/{id}/edit', [AdminUserController::class, 'update'])->name('User.update');
    Route::DELETE('/admin/users/viewUser/{id}', [AdminUserController::class, 'destroy'])->name('viewUser.delete');

    // Admin User Management - Change User Password
    Route::get('/admin/user/changepassword', [AdminUserController::class, 'displaychangepassword'])->name('display.change.password');
   Route::post('/admin/user/changepassword', [AdminUserController::class, 'updatechangePassword'])->name('update.change.Password');


   // Admin Settings Notify Users
    Route::get('Settings/notify', [AdminSettingsController::class, 'notify'])->name('Snotify');
    Route::post('Settings/notifystore', [AdminSettingsController::class, 'notifystore'])->name('Snotifystore');

    // Admin Support Management
    Route::get('/admin/appContacts', [AdminSettingsController::class, 'contactView'])->name('S.appContacts');
    Route::post('/admin/appContacts', [AdminSettingsController::class, 'contactAction'])->name('S.contactAction');

    // Admin trasactions
    Route::get('/admin/transactions/all', [AdminTransactionController::class, 'all'])->name('T.all');
    Route::get('/admin/transactions/processings', [AdminTransactionController::class, 'processings'])->name('T.processings');




});



