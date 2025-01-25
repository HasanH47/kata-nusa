<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Symfony\Component\Uid\Ulid;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Article extends Model
{
    use HasSEO, Lift;

    #[Cast('int')]
    #[Column(name: 'author_id')]
    #[Fillable]
    public ?int $authorId;

    #[Cast('string')]
    #[Column(name: 'title')]
    #[Fillable]
    public ?string $title;

    #[Cast('string')]
    #[Column(name: 'slug', default: 'generateSlug')]
    public ?string $slug;

    #[Cast('string')]
    #[Column(name: 'summary')]
    #[Fillable]
    public ?string $summary;

    #[Cast('string')]
    #[Column(name: 'thumbnail')]
    #[Fillable]
    public ?string $thumbnail;

    #[Cast('string')]
    #[Column(name: 'body')]
    #[Fillable]
    public ?string $body;

    #[Cast('int')]
    #[Column(name: 'views')]
    #[Fillable]
    public ?int $views;

    #[Cast('int')]
    #[Column(name: 'likes')]
    #[Fillable]
    public ?int $likes;

    #[Cast('boolean')]
    #[Column(name: 'is_published')]
    #[Fillable]
    public ?bool $isPublished;

    public function generateSlug(): string
    {
        $ulid = Ulid::generate();
        $title = Str::lower($this->title);
        $title = Str::replace(' ', '-', $title);

        return $title . '-' . $ulid;
    }

    /**
     * The author of the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the article comments associated with the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleComments()
    {
        return $this->hasMany(ArticleComment::class);
    }
}
