<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class AuthorFollower extends Model
{
    use Lift;

    #[Cast('int')]
    #[Column(name: 'author_id')]
    #[Fillable]
    public ?int $authorId;

    #[Cast('int')]
    #[Column(name: 'follower_id')]
    #[Fillable]
    public ?int $followerId;
}
