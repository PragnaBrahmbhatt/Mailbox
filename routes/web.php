<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SmtpController;
use App\Http\Controllers\MailboxController;
use App\Http\Controllers\GeneralSchedulerSetting;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SmsTemplateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role', 'index')->name('role.index')->middleware('permission:view.role');
        Route::get('role/create', 'create')->name('role.create')->middleware('permission:create.role');
        Route::post('role/store', 'store')->name('role.store')->middleware('permission:create.role');
        Route::get('role/{role}/edit', 'edit')->name('role.edit')->middleware('permission:edit.role');
        Route::post('role/{role}', 'update')->name('role.update')->middleware('permission:edit.role');
        Route::delete('role/{role}', 'destroy')->name('role.destroy')->middleware('permission:delete.role');
    });

    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission', 'index')->name('permission.index')->middleware('permission:view.permission');
        Route::get('permission/create', 'create')->name('permission.create')->middleware('permission:create.permission');
        Route::post('permission/store', 'store')->name('permission.store')->middleware('permission:create.permission');
        Route::get('permission/{permission}/edit', 'edit')->name('permission.edit')->middleware('permission:edit.permission');
        Route::post('permission/{permission}', 'update')->name('permission.update')->middleware('permission:edit.permission');
        Route::delete('permission/{permission}', 'destroy')->name('permission.destroy')->middleware('permission:delete.permission');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index')->middleware('permission:view.user');
        Route::get('user/create', 'create')->name('user.create')->middleware('permission:create.user');
        Route::post('user/store', 'store')->name('user.store')->middleware('permission:create.user');
        Route::get('user/{user}/edit', 'edit')->name('user.edit')->middleware('permission:edit.user');
        Route::post('user/{user}', 'update')->name('user.update')->middleware('permission:edit.user');
        Route::delete('user/{user}', 'destroy')->name('user.destroy')->middleware('permission:delete.user');
        Route::get('user/scheduler', 'scheduler')->name('user.scheduler');
        Route::post('user/scheduler/create', 'schedulerStore')->name('user.scheduler.store');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::post('/profile', 'update')->name('profile.update');
    });

    Route::controller(MediaController::class)->group(function () {
        Route::get('/gallery', 'index')->name('gallery.index');
        Route::post('/gallery/store', 'store')->name('gallery.store');
        Route::post('gallery/{media}', 'destroy')->name('gallery.destroy');
        Route::get('/gallery/fetch', 'fetchMediaById')->name('gallery.fetch');
    });

    Route::controller(EmailTemplateController::class)->group(function () {
        Route::get('/email', 'index')->name('email.template.index')->middleware('permission:view.emailTemplate');
        Route::get('/email/create', 'create')->name('email.template.create')->middleware('permission:create.emailTemplate');
        Route::post('/email/store', 'store')->name('email.template.store')->middleware('permission:create.emailTemplate');
        Route::get('/email/{email}/edit', 'edit')->name('email.template.edit')->middleware('permission:edit.emailTemplate');
        Route::post('email/{email}', 'update')->name('email.template.update')->middleware('permission:edit.emailTemplate');
        Route::delete('email/{email}', 'destroy')->name('email.template.destroy')->middleware('permission:delete.emailTemplate');
    });

    Route::controller(SmsTemplateController::class)->group(function () {
        Route::post('/sms/send', 'sendSms')->name('sms.send')->middleware('permission:send.sms');
        Route::get('/sms', 'index')->name('sms.template.index')->middleware('permission:view.smsTemplate');
        Route::get('/sms/create', 'create')->name('sms.template.create')->middleware('permission:create.smsTemplate');
        Route::post('/sms/store', 'store')->name('sms.template.store')->middleware('permission:create.smsTemplate');
        Route::get('/sms/{sms}/edit', 'edit')->name('sms.template.edit')->middleware('permission:edit.smsTemplate');
        Route::post('sms/{sms}', 'update')->name('sms.template.update')->middleware('permission:edit.smsTemplate');
        Route::delete('sms/{sms}', 'destroy')->name('sms.template.destroy')->middleware('permission:delete.smsTemplate');
    });

    Route::controller(ImportController::class)->group(function () {
        Route::get('/import', 'index')->name('import.index');
        Route::post('import/store', 'store')->name('import.store');
    });
    Route::controller(GeneralSchedulerSetting::class)->group(function () {
        Route::get('/scheduler', 'index')->name('scheduler.index');
        Route::post('/scheduler/create', 'store')->name('scheduler.store');
    });
    
    Route::controller(GroupController::class)->group(function () {
        Route::get('/group', 'index')->name('group.index');
        Route::get('group/create', 'create')->name('group.create');
        Route::post('group/store', 'store')->name('group.store');
        Route::get('group/{group}/edit', 'edit')->name('group.edit');
        Route::post('group/{group}', 'update')->name('group.update');
        Route::delete('group/{group}', 'destroy')->name('group.destroy');
    });

    Route::controller(SmtpController::class)->group(function () {
        Route::get('/smtp', 'index')->name('smtp.index');
        Route::get('smtp/create', 'create')->name('smtp.create');
        Route::post('smtp/store', 'store')->name('smtp.store');
        Route::get('smtp/{smtp}/edit', 'edit')->name('smtp.edit');
        Route::post('smtp/{smtp}', 'update')->name('smtp.update');
        Route::delete('smtp/{smtp}', 'destroy')->name('smtp.destroy');
    });

    Route::controller(MailboxController::class)->group(function () {
        Route::get('/mailbox', 'index')->name('mailbox.index');
        Route::get('mailbox/create', 'create')->name('mailbox.create');
        Route::post('mailbox/store', 'store')->name('mailbox.store');
        Route::get('mailbox/{mailbox}/edit', 'edit')->name('mailbox.edit');
        Route::post('mailbox/{mailbox}', 'update')->name('mailbox.update');
        Route::delete('mailbox/{mailbox}', 'destroy')->name('mailbox.destroy');
    });
});