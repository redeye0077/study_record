<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

Route::post('/guest-login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@guestLogin')->name('guest.login');

Route::middleware(['auth'])->group(function () {
    // index画面の取得
    Route::get('/index', 'App\Http\Controllers\IndexController@index')->name('index.index');

    // share画面の取得
    Route::get('/share', 'App\Http\Controllers\ShareController@index')->name('share.index');

    // group_share画面の取得
    Route::get('/group_share', 'App\Http\Controllers\GroupShareController@index')->name('group.share.index');

    // subject画面の取得
    Route::get('/subject', 'App\Http\Controllers\SubjectController@index')->name('subject.index');

    // study_challenges/new画面の取得と処理
    Route::get('/study_challenges/new', 'App\Http\Controllers\StudyChallengesNewController@index')->name('study.challenges.new.index');
    Route::post('/study_challenges/new', 'App\Http\Controllers\StudyChallengesNewController@store')->name('study.challenges.new.store');

    // calendar画面の取得
    Route::get('/calendar', 'App\Http\Controllers\CalendarController@index')->name('calendar.index');

    // study_log画面の取得と処理
    Route::get('/study_log', 'App\Http\Controllers\StudyLogController@index')->name('study.log.index');
    Route::post('/study_log', 'App\Http\Controllers\StudyLogController@store')->name('study.log.store');

    // settings画面の取得
    Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings.index');

    // settings/password画面の取得
    Route::get('/settings/password', 'App\Http\Controllers\SettingsPasswordController@index')->name('settings.password.index');

    // settings/withdrawal画面の取得と処理
    Route::get('/settings/withdrawal', 'App\Http\Controllers\SettingsWithdrawalController@index')->name('settings.withdrawal.index');
    Route::post('/settings/withdrawal', 'App\Http\Controllers\SettingsWithdrawalController@withdrawal')->name('settings.withdrawal.post');

    //メッセージ画面
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
});

Route::prefix('settings')->middleware('auth')->group(function () {
    Route::get('/login_id', 'App\Http\Controllers\SettingsLoginIdController@index')->name('settings.login.id');
    Route::match(['put', 'patch'], '/login_id', 'App\Http\Controllers\SettingsLoginIdController@update')->name('settings.login.id.update');
});
