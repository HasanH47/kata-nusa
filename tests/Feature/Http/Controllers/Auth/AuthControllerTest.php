<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_show_registration_form()
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertViewIs('auth.register');
    }

    public function test_show_login_form()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    public function test_register()
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(8, 20),
        ];

        $data['password_confirmation'] = $data['password'];

        $this->post(route('register'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function test_login()
    {
        $password = $this->faker->password(8, 20);

        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $this->post(route('login'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    public function test_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('logout'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }
}
