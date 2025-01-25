<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Lift;

#[HasMany(ArticleCategory::class)]
class Category extends Model
{
    use Lift;

    #[Cast('string')]
    #[Column(name: 'name')]
    #[Fillable]
    public ?string $name;
}
