<?php

namespace App\Services\Auth;

use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $remember = $data['remember'];

        if (Auth::attempt($credentials, $remember)) {
            session()->regenerate();

            return [
                'status' => true,
                'message' => 'Login Berhasil!',
                'intended_url' => redirect()->intended()->getTargetUrl(),
            ];
        }

        return [
            'status' => false,
            'message' => 'Email atau password salah!',
        ];
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Author::create([
            'user_id' => $user->id,
            'username' => $data['username'],
        ]);

        return [
            'status' => true,
            'message' => 'Registrasi Berhasil!',
            'intended_url' => redirect()->intended(route('login'))->getTargetUrl(),
        ];
    }

    public function logout()
    {
        Auth::logout();
    }
}
