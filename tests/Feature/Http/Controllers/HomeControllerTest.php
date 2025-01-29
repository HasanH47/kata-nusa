<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_index()
    {
        Article::factory()->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('home');
    }

    public function test_about()
    {
        $author = Author::factory()->create();

        Article::factory()
            ->count(1000)
            ->create([
                'author_id' => $author->id,
            ]);

        $this->get(route('about'))->assertStatus(200)->assertViewIs('about');
    }

    public function test_trending()
    {
        Article::factory()->create();

        $this->get(route('trending'))
            ->assertStatus(200)
            ->assertViewIs('trending');
    }

    public function test_trending_period_monthly()
    {
        Article::factory()->create();

        $this->get(route('trending', ['period' => 'monthly']))
            ->assertStatus(200)
            ->assertViewIs('trending');
    }

    public function test_trending_period_weekly()
    {
        Article::factory()->create();

        $this->get(route('trending', ['period' => 'weekly']))
            ->assertStatus(200)
            ->assertViewIs('trending');
    }

    public function test_trending_period_yearly()
    {
        $this->get(route('trending', ['period' => 'yearly']))
            ->assertStatus(200)
            ->assertViewIs('trending');
    }
}
