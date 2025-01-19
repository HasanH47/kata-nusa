<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Author extends Model
{
    use Lift;

    #[Cast('int')]
    #[Column(name: 'user_id')]
    #[Fillable]
    public int $userId;

    #[Cast('string')]
    #[Column(name: 'username')]
    #[Fillable]
    public string $username;

    #[Cast('string')]
    #[Column(name: 'bio')]
    #[Fillable]
    public string $bio;

    #[Cast('string')]
    #[Column(name: 'avatar')]
    #[Fillable]
    public string $avatar;

    #[Cast('string')]
    #[Column(name: 'address')]
    #[Fillable]
    public string $address;

    #[Cast('string')]
    #[Column(name: 'website')]
    #[Fillable]
    public string $website;
}
