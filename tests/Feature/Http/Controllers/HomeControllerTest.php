<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_index()
    {
        $article = Article::factory()->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    public function test_about()
    {
        $author = Author::factory()->create();

        Article::factory()->count(1000)->create([
            'author_id' => $author->id,
        ]);

        $this->get(route('about'))
            ->assertStatus(200)
            ->assertSee('Tentang KataNusa');
    }

    public function test_trending()
    {
        $article = Article::factory()->create();

        $this->get(route('trending'))
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    public function test_trending_period_monthly()
    {
        $article = Article::factory()->create();

        $this->get(route('trending', ['period' => 'monthly']))
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    public function test_trending_period_weekly()
    {
        $article = Article::factory()->create();

        $this->get(route('trending', ['period' => 'weekly']))
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    public function test_trending_period_yearly()
    {
        $article = Article::factory()->create();

        $this->get(route('trending', ['period' => 'yearly']))
            ->assertStatus(200)
            ->assertSee($article->title);
    }
}
