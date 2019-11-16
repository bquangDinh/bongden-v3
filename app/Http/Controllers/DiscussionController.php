<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiscussionRequest;

use App\Http\Services\DiscussionService;

use Auth;

class DiscussionController extends Controller
{
    public function create(DiscussionRequest $request){
      $err = DiscussionService::create_discussion_with_request(Auth::user()->id,$request);

      if($err == -1){
        return view('userpage.user_blank')->with('error','Oops ! Có gì đó đã xảy ra và chúng mình không thể tạo thảo luận cho bạn. Hãy báo cáo nếu bạn có vấn đề cho đội ngũ Bóng Đèn nhé.');
      }

      return view('userpage.user_blank')->with('success','Tạo thảo luận thành công.');
    }

    public function get_discussion_categories(){
      return DiscussionService::get_discussion_categories(true);
    }

    public function add_comment_with_ajax(Request $request){
      if(Auth::check()){
        $comment = DiscussionService::add_comment_with_request(Auth::user()->id,$request);
        return view('components.comment_block')->with('comment',$comment);
      }

      return -1;
    }

    public function add_reply_with_ajax(Request $request){
      if(Auth::check()){
        $reply = DiscussionService::add_reply_with_request(Auth::user()->id,$request);
        return view('components.reply_block')->with('reply',$reply)->with('root',$request->root);
      }

      return -1;
    }

    public function like_comment_with_ajax(Request $request){
      if(Auth::check()){
        $like = DiscussionService::like_comment_with_request(Auth::user()->id,$request);
        $count = DiscussionService::comment_like_count($request->comment_id);
        return $count;
      }

      return -1;
    }

    public function unlike_comment_with_ajax(Request $request){
      if(Auth::check()){
        DiscussionService::unlike_comment_with_request(Auth::user()->id,$request);
        $count = DiscussionService::comment_like_count($request->comment_id);
        return $count;
      }

      return -1;
    }
}
