<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Article extends Model
{
    use HasFactory, Lift;

    #[Cast('int')]
    #[Column(name: 'author_id')]
    #[Fillable]
    public ?int $author_id;

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
    public ?bool $is_published;

    public function generateSlug(): string
    {
        $ulid = Ulid::generate();
        $title = Str::lower($this->title);
        $title = Str::replace(' ', '-', $title);

        return $title . '-' . $ulid;
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn($thumbnail) => $thumbnail
                ? asset('storage/articles/thumbnails/' . $this->getRawOriginal('slug') . '/' . $thumbnail)
                : null,
            set: fn($thumbnail) => $thumbnail ? basename($thumbnail) : null,
        );
    }

    public function setEstimatedReadingTime(): int
    {
        $words = Str::wordCount($this->body);

        return (int) ceil($words / 200);
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

    /**
     * Get the article categories associated with the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleCategories()
    {
        return $this->hasMany(ArticleCategory::class);
    }
}
