<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Hidden;
use WendellAdriel\Lift\Lift;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Lift, Notifiable;

    #[Cast('string')]
    #[Column(name: 'name')]
    #[Fillable]
    public ?string $name;

    #[Cast('string')]
    #[Column(name: 'email')]
    #[Fillable]
    public ?string $email;

    #[Cast('string')]
    #[Column(name: 'password')]
    #[Fillable]
    #[Hidden]
    public ?string $password;

    #[Cast('datetime')]
    #[Column(name: 'email_verified_at')]
    #[Hidden]
    public ?Carbon $email_verified_at;

    #[Cast('string')]
    #[Column(name: 'remember_token')]
    #[Hidden]
    public ?string $remember_token;
}
