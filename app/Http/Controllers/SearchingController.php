<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SearchingService;

class SearchingController extends Controller
{
    public function search_term(Request $request){
      $query = $request->get('query');

      if($query == ""){
        return redirect()->to('/');
      }

      $articles_by_name = SearchingService::search_by_article_name($query);
      $articles_by_tag  = SearchingService::search_by_article_tag($query);
      $articles_by_subject = SearchingService::search_by_article_subject($query);
      return view('searching_found')->with('articles',$articles_by_name)->with('articles_with_tag',$articles_by_tag)->with('articles_with_subject',$articles_by_subject)->with('query',$query);
    }
}
