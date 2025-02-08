<?php

namespace App\Services\Dashboard\Articles;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
  use UploadImageTrait;

  public function store(array $data)
  {
    $user = Auth::user();
    $author = $user->author;

    $article = Article::create([
      'author_id' => $author->id,
      'title' => $data['title'],
      'summary' => $data['summary'],
      'body' => $data['body'],
      'is_published' => $data['is_published'],
      'published_at' => $data['is_published'] ? Carbon::now() : null
    ]);

    $this->storeCategories($data['tags'], $article);

    $path = 'articles/thumbnails/' . $author->uuid;

    $thumbnail = $this->uploadImage($path, $data['thumbnail'], $article->slug, $article->uuid);

    $article->update([
      'thumbnail' => $thumbnail
    ]);

    return [
      'status' => true,
      'message' => 'Artikel Berhasil Dibuat!',
      'intended_url' => redirect()->intended(route('dashboard.articles.index'))->getTargetUrl(),
    ];
  }

  private function storeCategories(array $data, $article)
  {
    foreach ($data as $tagsString) {
      $tagsArray = json_decode($tagsString, true);

      ArticleCategory::where('article_id', $article->id)->delete();

      foreach ($tagsArray as $tag) {
        $tag = trim($tag);

        $category = Category::firstOrCreate([
          'name' => $tag,
        ]);

        ArticleCategory::firstOrCreate([
          'article_id' => $article->id,
          'category_id' => $category->id
        ]);
      }
    }
  }

  public function update(array $data, $articleId)
  {
    $user = Auth::user();
    $author = $user->author;

    $article = Article::where('author_id', $author->id)->where('uuid', $articleId)->first();

    $article->update([
      'title' => $data['title'],
      'summary' => $data['summary'],
      'body' => $data['body'],
      'is_published' => $data['is_published'],
      'published_at' => $data['is_published'] ? Carbon::now() : null
    ]);

    $this->storeCategories($data['tags'], $article);

    if (isset($data['thumbnail'])) {
      $path = 'articles/thumbnails/' . $author->uuid;
      $thumbnail = $this->uploadImage($path, $data['thumbnail'], $article->slug, $article->uuid, $article->thumbnail);
      $article->update([
        'thumbnail' => $thumbnail
      ]);
    }

    return [
      'status' => true,
      'message' => 'Artikel Berhasil Diubah!',
      'intended_url' => redirect()->intended(route('dashboard.articles.index'))->getTargetUrl(),
    ];
  }
}
