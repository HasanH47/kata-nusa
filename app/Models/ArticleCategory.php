<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class ArticleCategory extends Model
{
    use HasFactory, Lift;

    #[Cast('int')]
    #[Column(name: 'article_id')]
    #[Fillable]
    public ?int $article_id;

    #[Cast('int')]
    #[Column(name: 'category_id')]
    #[Fillable]
    public ?int $category_id;

    /**
     * Get the article that owns the ArticleCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the category that owns the ArticleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
