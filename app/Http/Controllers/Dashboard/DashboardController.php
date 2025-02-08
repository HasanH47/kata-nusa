<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $author = $user->author;

        $countArticle = Article::where('author_id', $author->id)->count();
        $countArticleLike = Article::where('author_id', $author->id)->sum('likes');
        $countFollower = $author->followers()->count();

        $articles = Article::where('author_id', $author->id)->orderBy('published_at', 'desc')->limit(10)->get();

        return view('dashboard.index', [
            'countArticle' => $countArticle,
            'countArticleLike' => $countArticleLike,
            'countFollower' => $countFollower,
            'articles' => $articles,
        ]);
    }
}
