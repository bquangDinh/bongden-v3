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
}
