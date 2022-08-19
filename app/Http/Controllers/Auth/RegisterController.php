<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        auth()->logout();
        return view('auth.register');
    }

    public function store(RegisterRequest $request, User $user)
    {
        $user->fill($request->validated())->save();
        Auth::login($user);
        return redirect()->route('record.index');
    }
}
