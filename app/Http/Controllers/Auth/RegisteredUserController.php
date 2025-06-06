<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z0-9!@#$%^&*()\-_=+{}\[\];:\'",.<>?\\|`~]+$/', 'max:50', 'unique:users'],
            'email' => ['required', 'email:filter,dns', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'regex:/^[a-zA-Z0-9!@#$%^&*()\-_=+{}\[\];:\'",.<>?\\|`~]+$/', 'min:8', 'max:60', 'confirmed'],
        ]);
        // Rules\Password::defaults()
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
        ]);

        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect('/dashboard');
    }
}
