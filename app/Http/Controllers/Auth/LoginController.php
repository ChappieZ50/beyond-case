<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        auth()->logout();
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('record.index');
        }

        return back()->withErrors([
            'incorrect_credentials' => 'Incorrect credentials'
        ]);
    }
}
