<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function list(){
        return view('pages.article.article');
    }

    public function show(Request $request, $slug){
        $article = Article::with('categories','user')->where('slug_article', $slug)->where('status_article','publish')->first();
        views($article)->record();
        return view('pages.article.detail-article',[
            'article' => $article
        ]);
    }

    public function index(){
        return view('dashboard.manage-article.article');
    }

    public function createDashboard()
    {
        return view('dashboard.manage-article.formArticle',[
            'action' => 'store',
            'uniqId' => null,
            'categories' => Category::where('status_category','publish')->get()
        ]);
    }

    public function storeDashboard(ArticleRequest $articleRequest){
        DB::beginTransaction();
        try{
            $location = $articleRequest->thumbnail->store('thumbnail_article');
            Article::create([
                'user_id' => Auth::id(),
                'status_article' => $articleRequest->status ?? 'draft',
                'title_article' => $articleRequest->title,
                'categories_id' => $articleRequest->categories_id,
                'body_article' => $articleRequest->article,
                'image_article' => 'storage/'.$location
            ]);
            DB::commit();
            session()->flash('messageAction','success');
            return to_route('manage-article');
        }
        catch(\Throwable $th){
            DB::rollBack();
            Log::error('error store article', [
                'error' => $th->getMessage(),
            ]);
            session()->flash('messageAction','error');
            return redirect()->back();
        }
    }

    public function editDashboard(Request $request){
        if (is_null($request->slug)){
            return to_route('manage-article');
        }

        $article = Article::where('slug_article',$request->slug)->first();
        if(is_null($article)){
            return to_route('manage-article');
        }

        return view('dashboard.manage-article.formArticle',[
            'action' => 'update',
            'uniqId' => encrypt($article->id),
            'status' => $article->status_article,
            'title' => $article->title_article,
            'categories_id' => $article->categories_id,
            'categories' => Category::where('status_category','publish')->get(),
            'article' => $article->body_article,
            'thumbnail_now' => $article->image_article

        ]);
    }

    public function updateDashboard(ArticleRequest $articleRequest){
        DB::beginTransaction();
        try{
            $article = Article::findOrFail(decrypt($articleRequest->uniqId));
            $location = $article->image_article;
            if(!is_null($articleRequest->thumbnail)){
                $location ='storage/' .$articleRequest->thumbnail->store('thumbnail_article');
            }

            $article->update([
                'uniqId' => encrypt($articleRequest->id),
                'status_article' => $articleRequest->status ?? 'draft',
                'title_article' => $articleRequest->title,
                'categories-id' => $articleRequest->categories_id,
                'body_article' => $articleRequest->article,
                'image_article' => $location
            ]);
            DB::commit();
            session()->flash('messageAction','success');
            return to_route('manage-article');
        } catch(\Throwable $th){
            DB::rollBack();
            Log::error('error update article', [
                'error' => $th->getMessage(),
            ]);
            session()->flash('messageAction','error');
            return redirect()->back();
        }
    }
}
