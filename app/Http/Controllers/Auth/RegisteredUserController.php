<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
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
            'name' => ['required', 'string', 'max:255'],
            'licencenumber' => ['required', 'string', 'max:255', 'unique:'.Driver::class],
            'idnumber' => ['required', 'string', 'max:255', 'unique:'.Driver::class],
            'phonenumber' => ['required', 'string', 'max:255', 'unique:'.Driver::class],
            'dob' => ['required', 'string', 'max:255'],
            'bloodgroup' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Driver::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Driver::create([
            'name' => $request->name,
            'licencenumber' => $request->licencenumber,
            'idnumber' => $request->idnumber,
            'phonenumber' => $request->phonenumber,
            'dob' => $request->dob,
            'bloodgroup' => $request->bloodgroup,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
