<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Category extends Model
{
    use Lift;

    #[Cast('string')]
    #[Column(name: 'name')]
    #[Fillable]
    public ?string $name;
}
