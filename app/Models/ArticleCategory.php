<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Lift;

#[BelongsTo(Article::class)]
class ArticleCategory extends Model
{
    use Lift;

    #[Cast('int')]
    #[Column(name: 'article_id')]
    #[Fillable]
    public ?int $articleId;

    #[Cast('int')]
    #[Column(name: 'category_id')]
    #[Fillable]
    public ?int $categoryId;
}
