<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ArticleService;

use Auth;

class UserController extends Controller
{
    public function show_dashboard(){
      return view('userpage.user_dashboard');
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
}
