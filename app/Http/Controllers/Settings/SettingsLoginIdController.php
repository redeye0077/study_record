<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsLoginIdRequest;

class SettingsLoginIdController extends Controller
{
    public function index()
    {
        return view('settings.login_id');
    }

    public function update(SettingsLoginIdRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('settings.login.id')->with('success', 'ログインIDを更新しました!');
    }
}
