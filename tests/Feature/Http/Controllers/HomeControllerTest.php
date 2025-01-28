<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    private const TRENDING_DI_KATANUSA_MESSAGE = 'Trending di KataNusa';

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

        Article::factory()
            ->count(1000)
            ->create([
                'author_id' => $author->id,
            ]);

        $this->get(route('about'))->assertStatus(200)->assertSee('Tentang KataNusa');
    }

    public function test_trending()
    {
        Article::factory()->create();

        $this->get(route('trending'))
            ->assertStatus(200)
            ->assertSee(self::TRENDING_DI_KATANUSA_MESSAGE);
    }

    public function test_trending_period_monthly()
    {
        Article::factory()->create();

        $this->get(route('trending', ['period' => 'monthly']))
            ->assertStatus(200)
            ->assertSee(self::TRENDING_DI_KATANUSA_MESSAGE);
    }

    public function test_trending_period_weekly()
    {
        Article::factory()->create();

        $this->get(route('trending', ['period' => 'weekly']))
            ->assertStatus(200)
            ->assertSee(self::TRENDING_DI_KATANUSA_MESSAGE);
    }

    public function test_trending_period_yearly()
    {
        $this->get(route('trending', ['period' => 'yearly']))
            ->assertStatus(200)
            ->assertSee(self::TRENDING_DI_KATANUSA_MESSAGE);
    }
}
