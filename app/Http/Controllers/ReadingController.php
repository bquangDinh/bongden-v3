<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\ArticleService;

use Auth;

class ReadingController extends Controller
{
  public function add_comment_with_ajax(Request $request){
    if(Auth::check()){
      $comment = ArticleService::add_comment_with_request(Auth::user()->id,$request);
      return view('components.comment_block')->with('comment',$comment);
    }

    return -1;
  }

  public function add_reply_with_ajax(Request $request){
    if(Auth::check()){
      $reply = ArticleService::add_reply_with_request(Auth::user()->id,$request);
      return view('components.reply_block')->with('reply',$reply)->with('root',$request->root);
    }

    return -1;
  }

  public function like_comment_with_ajax(Request $request){
    if(Auth::check()){
      $like = ArticleService::like_comment_with_request(Auth::user()->id,$request);
      $count = ArticleService::comment_like_count($request->comment_id);
      return $count;
    }

    return -1;
  }

  public function unlike_comment_with_ajax(Request $request){
    if(Auth::check()){
      ArticleService::unlike_comment_with_request(Auth::user()->id,$request);
      $count = ArticleService::comment_like_count($request->comment_id);
      return $count;
    }

    return -1;
  }
}
