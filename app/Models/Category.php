<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Category extends Model
{
    use HasFactory, Lift;

    #[Cast('string')]
    #[Column(name: 'name')]
    #[Fillable]
    public ?string $name;

    /**
     * Get the article categories that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleCategories()
    {
        return $this->hasMany(ArticleCategory::class);
    }
}
