<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ArticleService;
use App\Http\Services\UserAchievementService;

use Auth;

class UserController extends Controller
{
    public function show_dashboard(){
      $article_count_statistics = UserAchievementService::get_articles_count_statistics(Auth::user()->id,null);
      $article_count_by_subject_statistics = UserAchievementService::get_article_count_by_subject_statistics(Auth::user()->id);
      $exp_to_next_level = UserAchievementService::calculate_exp_to_next_level(Auth::user()->achieveDetail->level);
      $next_achievement = UserAchievementService::get_next_medal_by_level(Auth::user()->id);
      return view('userpage.user_dashboard')
      ->with('article_count_statistics',$article_count_statistics)
      ->with('exp_to_next_level',$exp_to_next_level)
      ->with('article_count_by_subject_statistics',$article_count_by_subject_statistics)
      ->with('next_medal',$next_achievement);
    }

    public function show_creating_article(){
      return view('userpage.user_creating_page');
    }

    public function show_rule(){
      return view('userpage.user_writing_article_rule_page');
    }

    public function show_article_list(){
      $articles = ArticleService::get_articles_with_user(Auth::user()->id);
      return view('userpage.user_article_list')->with('articles',$articles);
    }

    public function show_editing_article($article_id){
      $article = ArticleService::get_article($article_id);
      return view('userpage.user_updating_article_page')->with('article',$article);
    }

    public function show_creating_discussion(){
      return view('userpage.user_creating_discussion');
    }

    public function show_user_staticstic(){
      if(Auth::user()->hasRole('manager')){
        return view('userpage.user_analyzing_page');
      }

      return view('userpage.user_blank')->with('error','Bạn không có quyền để truy cập tính năng này');
    }
}
