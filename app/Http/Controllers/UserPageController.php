<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ArticleService;
use App\Http\Services\DiscussionService;
use App\Http\Services\UserAchievementService;

use App\Article;
use App\ArticleState;
use App\Discussion;
use App\User;

use Illuminate\Database\Eloquent\Builder;

class UserPageController extends Controller
{
    public function show_home_page(){
      $latest = Article::whereHas('getState',function(Builder $query){
        $query->where('state','uploaded');
      })->latest()->first();

      $recents = null;

      if($latest){
        $recents = Article::whereHas('getState',function(Builder $query){
          $query->where('state','uploaded');
        })->where('id','<>',$latest->id)->latest()->take(3)->get();
      }

      $recents_discussion = Discussion::latest()->take(4)->get();
      \Debugbar::info($latest);
      \Debugbar::info($recents);
      \Debugbar::info($recents_discussion);
      return view('homepage')->with('latest',$latest)->with('recents',$recents)->with('discussions',$recents_discussion);
    }

    public function show_reading_page($article_id){
      if(ArticleService::is_uploaded_article($article_id)){
        $article = ArticleService::get_article($article_id);
        return view('reading_article')->with('article',$article);
      }
      return redirect()->to('/');
    }

    public function show_articles_page(){
      $articles = Article::whereHas('getState',function(Builder $query){
        $query->where('state','uploaded');
      })->orderBy('created_at','desc')->simplePaginate(6);
      return view('articles')->with('articles',$articles);
    }

    public function show_forum_page(){
      $discussions = DiscussionService::get_all_discussion();
      return view('forum')->with('discussions',$discussions);
    }

    public function show_discussion_reading_page($discussion_id){
      $discussion = DiscussionService::get_discussion($discussion_id);
      return view('reading_discussion')->with('discussion',$discussion);
    }

    public function show_user_profile_preview(Request $request){
      $data = UserAchievementService::get_user_preview($request->user_id);
      return $data;
    }
}
