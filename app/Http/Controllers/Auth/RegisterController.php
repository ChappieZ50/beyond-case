<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    protected UserContract $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        auth()->logout();
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $id = $this->user->fill($request->validated())->save();
        Auth::loginUsingId($id);
        return redirect()->route('record.index');
    }
}
