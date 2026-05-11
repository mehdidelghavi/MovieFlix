<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Articles\StoreArticleRequest;
use App\Http\Requests\Dashboard\Articles\UpdateArticleRequest;
use App\Models\Articles;
use App\Services\Contracts\ArticleServiceInterface;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function __construct(private ArticleServiceInterface $articleService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->articleService->getDatatable();
        }
        return view("Dashboard.Articles.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.Articles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $createArticle = $this->articleService->store($request->validated());
        if ($createArticle){
            return redirect()->route('dashboard.articles')->with("success", "مقاله با موفقیت ثبت شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در ثبت مقاله به وجود آمد");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        return view('Dashboard.Articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Articles $article)
    {
        $updateArticle = $this->articleService->update($request->validated(), $article);
        if ($updateArticle){
            return redirect()->route('dashboard.articles')->with("success", "مقاله با موفقیت ویرایش شد");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در ویرایش مقاله به وجود آمد");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        $deleteArticle = $this->articleService->delete($article);
        if ($deleteArticle){
            return redirect()->route('dashboard.articles')->with("success", "مقاله با موفقیت حذف شد");
        } else {
            return redirect()->route('dashboard.articles')->with("failed", "متاسفانه خطایی در حذف مقاله به وجود آمد");
        }
    }

    public function multiDelete(Request $request){
        $request->validate([
            'articles' => ['required','array']
        ]);
        $deleteArticles = $this->articleService->multiDelete($request->articles);
        if ($deleteArticles){
            return redirect()->back()->with('success', 'مقاله ها با موفقیت حذف شدند');
        } else {
            return redirect()->back()->with('failed', 'متاسفانه مقاله ها حذف نشدند');
        }
    }
}
