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
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // index画面のルート設定
    Route::get('/index', 'App\Http\Controllers\IndexController@index')->name('index.index');

    // share画面のルート設定
    Route::get('/share', 'App\Http\Controllers\ShareController@index')->name('share.index');

    // group_share画面のルート設定
    Route::get('/group_share', 'App\Http\Controllers\GroupShareController@index')->name('GroupShare.index');

    // subject画面のルート設定
    Route::get('/subject', 'App\Http\Controllers\SubjectController@index')->name('subject.index');

    // study_challenges画面のルート設定
    Route::get('/study_challenges', 'App\Http\Controllers\StudyChallengesController@index')->name('StudyChallenges.index');

    // study_challenges/new画面のルート設定
    Route::get('/study_challenges/new', 'App\Http\Controllers\StudyChallengesNewController@index')->name('StudyChallengesNew.index');

    // calendar画面のルート設定
    Route::get('/calendar', 'App\Http\Controllers\CalendarController@index')->name('calendar.index');

    // study_log画面のルート設定
    Route::get('/study_log', 'App\Http\Controllers\StudyLogController@index')->name('StudyLog.index');

    // settings画面のルート設定
    Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings.index');

    // settings/password画面のルート設定
    Route::get('/settings/password', 'App\Http\Controllers\SettingsPasswordController@index')->name('SettingsPassword.index');

    // settings/withdrawal画面のルート設定
    Route::get('/settings/withdrawal', 'App\Http\Controllers\SettingsWithdrawalController@index')->name('SettingsWithdrawal.index');
    Route::post('/settings/withdrawal', 'App\Http\Controllers\SettingsWithdrawalController@withdrawal')->name('SettingsWithdrawal.post');
});

Route::prefix('settings')->middleware('auth')->group(function () {
    Route::get('/login_id', 'App\Http\Controllers\SettingsLoginIdController@index')->name('SettingsLoginId');
    Route::match(['put', 'patch'], '/login_id', 'App\Http\Controllers\SettingsLoginIdController@update')->name('SettingsLoginId.update');
});
