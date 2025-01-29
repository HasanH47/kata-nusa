<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\TrendingRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(IndexRequest $request)
    {
        $page = $request->input('page', 1);

        $articles = Article::with(['author', 'articleComments'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $page);

        $trendingArticles = Article::where('is_published', true)->orderBy('views', 'desc')->limit(5)->get();

        $trendingCategories = Category::with(['articleCategories', 'articleCategories.article'])
            ->whereHas('articleCategories.article', function ($query) {
                $query->where('is_published', true);
            })
            ->limit(5)
            ->get();

        $trendingAuthors = Author::withCount('followers')->orderBy('followers_count', 'desc')->limit(5)->get();

        return view('home', [
            'articles' => $articles,
            'trendingArticles' => $trendingArticles,
            'trendingCategories' => $trendingCategories,
            'trendingAuthors' => $trendingAuthors,
        ]);
    }

    public function about()
    {
        $countAuthors = Author::count();
        $countArticlePublished = Article::where('is_published', true)->count();
        $countArticleRead = Article::where('is_published', true)->sum('views');

        return view('about', [
            'countAuthors' => $this->formatNumber($countAuthors),
            'countArticlePublished' => $this->formatNumber($countArticlePublished),
            'countArticleRead' => $this->formatNumber($countArticleRead),
        ]);
    }

    private function formatNumber($number)
    {
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K+';
        }

        return $number;
    }

    public function trending(TrendingRequest $request)
    {
        $period = $request->input('period', 'daily');
        $query = Article::with(['author', 'articleComments', 'articleCategories'])->where('is_published', true);

        switch ($period) {
            case 'monthly':
                $query->where('updated_at', '>=', Carbon::now()->subMonth());
                break;
            case 'weekly':
                $query->where('updated_at', '>=', Carbon::now()->subWeek());
                break;
            case 'yearly':
                $query->where('updated_at', '>=', Carbon::now()->subYear());
                break;
            case 'daily':
            default:
                $query->where('updated_at', '>=', Carbon::now()->subDay());
                break;
        }

        $articles = $query->orderBy('views', 'desc')->limit(10)->get();

        return view('trending', [
            'articles' => $articles,
        ]);
    }
}
