<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Hidden;
use WendellAdriel\Lift\Lift;

class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Lift, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    #[Cast('string')]
    #[Column(name: 'remember_token')]
    #[Hidden]
    public ?string $rememberToken;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
