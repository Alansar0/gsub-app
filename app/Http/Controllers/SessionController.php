<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle the incoming authentication request.
     */
    public function store(Request $request)
    {
        // 1. Validate the minimum credentials (login field and password)
        // We are expecting a field named 'login' from the form (which we fixed in the view)
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Determine if the 'login' input is an email or a phone number
        // PHP's filter_var checks if the string looks like a valid email.
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // 3. Create the final credentials array for Auth::attempt
        // Example if user types "john@mail.com": ['email' => 'john@mail.com', 'password' => 'secret']
        // Example if user types "07012345678": ['phone_number' => '07012345678', 'password' => 'secret']
        $authCredentials = [
            $loginField => $credentials['login'],
            'password' => $credentials['password'],
        ];

        // 4. Attempt authentication
        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 5. If attempt failed, throw validation error back to the form
        throw ValidationException::withMessages([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }
}
