<?php

namespace App\Http\Controllers\Dashboard\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Articles\IndexRequest;
use App\Http\Requests\Dashboard\Articles\StoreRequest;
use App\Http\Requests\Dashboard\Articles\UpdateRequest;
use App\Models\Article;
use App\Services\Dashboard\Articles\ArticleService;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(IndexRequest $request)
    {
        $user = Auth::user();
        $author = $user->author;

        $page = $request->input('page', 1);
        $published = $request->input('published', true);

        $countArticlePublished = Article::where('author_id', $author->id)->where('is_published', true)->count();
        $countArticleDraft = Article::where('author_id', $author->id)->where('is_published', false)->count();
        $articles = Article::where('author_id', $author->id)->where('is_published', $published)->orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $page);

        return view('dashboard.articles.index', [
            'countArticlePublished' => $countArticlePublished,
            'countArticleDraft' => $countArticleDraft,
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('dashboard.articles.create');
    }

    public function store(StoreRequest $request)
    {
        $article = $this->articleService->store($request->validated());

        return redirect($article['intended_url'])->with('alert', [
            'type' => 'success',
            'message' => $article['message'],
        ]);
    }

    public function edit($articleId)
    {
        $user = Auth::user();
        $author = $user->author;

        $article = Article::with([
            'articleCategories',
            'articleCategories.category'
        ])->where('author_id', $author->id)->where('uuid', $articleId)->first();

        return view('dashboard.articles.edit', [
            'article' => $article
        ]);
    }

    public function update(UpdateRequest $request, $articleId)
    {
        $article = $this->articleService->update($request->validated(), $articleId);

        return redirect($article['intended_url'])->with('alert', [
            'type' => 'success',
            'message' => $article['message'],
        ]);
    }

    public function destroy($articleId)
    {
        $user = Auth::user();
        $author = $user->author;

        $article = Article::where('author_id', $author->id)->where('uuid', $articleId)->first();

        $article->delete();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Artikel Berhasil Dihapus!',
        ]);
    }
}
