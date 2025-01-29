<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $login = $this->authService->login($request->validated());

        if ($login['status']) {
            session()->flash('alert', [
                'type' => 'success',
                'message' => $login['message'],
            ]);

            return redirect($login['intended_url']);
        }

        return back()
            ->withErrors(['login' => $login['message']])
            ->withInput($request->only('email', 'remember'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $register = $this->authService->register($request->validated());

        if ($register['status']) {
            session()->flash('alert', [
                'type' => 'success',
                'message' => $register['message'],
            ]);

            return redirect($register['intended_url']);
        }

        return back()
            ->withErrors(['register' => $register['message']])
            ->withInput($request->only('name', 'email', 'username'));
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect('/');
    }
}
