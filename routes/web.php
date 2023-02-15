<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesenpm run dev
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// index画面のルート設定
Route::get('/index', 'App\Http\Controllers\IndexController@index')->name('index.index')->middleware('auth');

// share画面のルート設定
Route::get('/share', 'App\Http\Controllers\ShareController@index')->name('share.index')->middleware('auth');

// group_share画面のルート設定
Route::get('/group_share', 'App\Http\Controllers\Group_ShareController@index')->name('group_share.index')->middleware('auth');

// subject画面のルート設定
Route::get('/subject', 'App\Http\Controllers\SubjectController@index')->name('subject.index')->middleware('auth');

// study_challenges画面のルート設定
Route::get('/study_challenges', 'App\Http\Controllers\Study_ChallengesController@index')->name('study_challenges.index')->middleware('auth');

// study_challenges/new画面のルート設定
Route::get('/study_challenges/new', 'App\Http\Controllers\Study_Challenges_NewController@index')->name('study_challenges_new.index')->middleware('auth');

// calendar画面のルート設定
Route::get('/calendar', 'App\Http\Controllers\CalendarController@index')->name('calendar.index')->middleware('auth');

// study_log画面のルート設定
Route::get('/study_log', 'App\Http\Controllers\Study_LogController@index')->name('study_log.index')->middleware('auth');

// settings画面のルート設定
Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings.index')->middleware('auth');

// settings/login_id画面のルート設定
Route::get('/settings/login_id', 'App\Http\Controllers\Settings_Login_IDController@index')->name('settings_login_id.index')->middleware('auth');

// settings/password画面のルート設定
Route::get('/settings/password', 'App\Http\Controllers\Settings_PasswordController@index')->name('settings_password.index')->middleware('auth');

// settings/withdrawal画面のルート設定
Route::get('/settings/withdrawal', 'App\Http\Controllers\Settings_WithdrawalController@index')->name('settings_withdrawal.index')->middleware('auth');
