<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ArticleService;

use App\Article;
use App\ArticleState;

class UserPageController extends Controller
{
    public function show_home_page(){
      $latest = ArticleState::where('state','uploaded')->latest()->first();
      $recents = ArticleState::where('state','uploaded')->where('id','<>',$latest->id)->latest()->take(3)->get();

      return view('homepage')->with('latest',$latest)->with('recents',$recents);
    }

    public function show_reading_page($article_id){
      if(ArticleService::is_uploaded_article($article_id)){
        $article = ArticleService::get_article($article_id);
        return view('reading_article')->with('article',$article);
      }
      return redirect()->to('/');
    }

    public function show_articles_page(){
      $articles = Article::with(['getState' => function($query){
        $query->where('state','uploaded');
      }])->orderBy('created_at','desc')->simplePaginate(6);
      return view('articles')->with('articles',$articles);
    }

    public function show_forum_page(){
      return view('forum');
    }
}
