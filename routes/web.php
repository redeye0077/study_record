<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\GroupShareController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudyChallengesNewController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\StudyLogController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\SettingsPasswordController;
use App\Http\Controllers\Settings\SettingsWithdrawalController;
use App\Http\Controllers\Settings\SettingsLoginIdController;


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

Route::post('/guest-login', [AuthenticatedSessionController::class, 'guestLogin'])->name('guest.login');

Route::middleware(['auth'])->group(function () {
    // index画面の取得
    Route::get('/index', [IndexController::class, 'index'])->name('index.index');

    // share画面の取得
    Route::get('/share', [ShareController::class, 'index'])->name('share.index');
    
    // group_share画面の取得
    Route::get('/group_share', [GroupShareController::class, 'index'])->name('group.share.index');

    // subject画面の取得
    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');

    // study_challenges/new画面の取得と処理
    Route::get('/study_challenges/new', [StudyChallengesNewController::class, 'index'])->name('study.challenges.new.index');
    Route::post('/study_challenges/new', [StudyChallengesNewController::class, 'store'])->name('study.challenges.new.store');

    // calendar画面の取得
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // study_log画面の取得と処理
    Route::get('/study_log', [StudyLogController::class, 'index'])->name('study.log.index');
    Route::post('/study_log', [StudyLogController::class, 'store'])->name('study.log.store');

    // settings画面の取得
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // settings/password画面の取得
    Route::get('/settings/password', [SettingsPasswordController::class, 'index'])->name('settings.password.index');

    // settings/withdrawal画面の取得と処理
    Route::get('/settings/withdrawal', [SettingsWithdrawalController::class, 'index'])->name('settings.withdrawal.index');
    Route::post('/settings/withdrawal', [SettingsWithdrawalController::class, 'withdrawal'])->name('settings.withdrawal.post');

    //メッセージ画面
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});

Route::prefix('settings')->middleware('auth')->group(function () {
    Route::get('/login_id', [SettingsLoginIdController::class, 'index'])->name('settings.login.id');
    Route::match(['put', 'patch'], '/login_id', [SettingsLoginIdController::class, 'update'])->name('settings.login.id.update');
});
