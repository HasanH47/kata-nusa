<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class ArticleComment extends Model
{
    use Lift;

    #[Cast('int')]
    #[Column(name: 'article_id')]
    #[Fillable]
    public ?int $article_id;

    #[Cast('int')]
    #[Column(name: 'author_id')]
    #[Fillable]
    public ?int $author_id;

    #[Cast('int')]
    #[Column(name: 'comment_id')]
    #[Fillable]
    public ?int $comment_id;

    #[Cast('string')]
    #[Column(name: 'body')]
    #[Fillable]
    public ?string $body;
}
