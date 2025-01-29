<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

class Author extends Model
{
    use HasFactory, Lift;

    #[Cast('int')]
    #[Column(name: 'user_id')]
    #[Fillable]
    public ?int $user_id;

    #[Cast('string')]
    #[Column(name: 'username')]
    #[Fillable]
    public ?string $username;

    #[Cast('string')]
    #[Column(name: 'bio')]
    #[Fillable]
    public ?string $bio;

    #[Cast('string')]
    #[Column(name: 'avatar')]
    #[Fillable]
    public ?string $avatar;

    #[Cast('string')]
    #[Column(name: 'address')]
    #[Fillable]
    public ?string $address;

    #[Cast('string')]
    #[Column(name: 'website')]
    #[Fillable]
    public ?string $website;

    #[Cast('string')]
    #[Column(name: 'uuid', default: 'generateUuid')]
    #[Fillable]
    public ?string $uuid;

    public function generateUuid(): string
    {
        return Uuid::uuid4()->toString();
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($avatar) => $avatar ? asset(
                'storage/authors/avatars/' . $this->getRawOriginal('uuid') . '/' . $avatar
            ) : null,
            set: fn($avatar) => $avatar ? basename($avatar) : null,
        );
    }

    /**
     * The user that owns the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The articles that belong to the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the followers of the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany(AuthorFollower::class, 'followed_author_id', 'id');
    }
}
