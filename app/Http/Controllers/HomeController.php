<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\AuthorFollower;
use App\Models\Category;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    public function index($page = 5, $is_following = false)
    {
        $articles = Article::with([
            'author',
            'articleComments',
        ])->where('is_published', true)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'page', $page);

        $trendingArticles = Article::where('is_published', true)->orderBy('views', 'desc')->take(5)->get();

        $trendingCategories = Category::with(['articleCategories', 'articleCategories.article'])
        ->whereHas('articleCategories.article', function ($query) {
            $query->where('is_published', true);
        })->get();

        $trendingAuthors = Author::withCount('followers')
        ->orderBy('followers_count', 'desc')
        ->take(5)
            ->get();

        return view('home', [
            'articles' => $articles,
            'trendingArticles' => $trendingArticles,
            'trendingCategories' => $trendingCategories,
            'trendingAuthors' => $trendingAuthors,
            'SEOData' => new SEOData(
                title: 'KataNusa - Beranda',
                description: 'KataNusa – Menyatukan Cerita dari Seluruh Nusantara'
            ),
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
            'SEOData' => new SEOData(
                title: 'Tentang Kami - KataNusa',
                description: 'KataNusa hadir sebagai platform yang menghubungkan para penulis dan pembaca dari berbagai latar belakang untuk berbagi cerita, pengetahuan, dan inspirasi. Kami percaya bahwa setiap tulisan, baik tentang teknologi, kehidupan, budaya, maupun ide-ide baru, memiliki nilai yang dapat memberikan perspektif segar dalam memahami dunia di sekitar kita. KataNusa adalah tempat bagi semua orang untuk menyuarakan pikiran dan menemukan wawasan baru.'
            ),
        ]);
    }

    private function formatNumber($number)
    {
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K+';
        }
        return $number;
    }

    public function trending()
    {
        return view('trending', [
            'SEOData' => new SEOData(
                title: 'Trending - KataNusa',
                description: 'KataNusa – Menyatukan Cerita dari Seluruh Nusantara'
            ),
        ]);
    }
}
