<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Services\ArticleService;
use App\Http\Services\FileService;
use Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function get_all_subjects(){
      return ArticleService::get_all_subjects(true);
    }

    public function get_tags_with_query(Request $request){
      //true means returning the result as select2 format
      return ArticleService::get_tags_with_query($request,true);
    }

    public function add_image(Request $request){
      $validation = Validator::make($request->all(),[
        'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      if($validation->passes()){
        $file = $request["cover"];
        $image = FileService::upload_image($file,Auth::user()->id);

        return $image->url;
      }

      return null;
    }

    public function get_article($id){
      return ArticleService::get_article($id);
    }

    public function create(ArticleRequest $request){
      $err = ArticleService::create_article_with_request(Auth::user()->id,$request);

      if($err == -1){
        return view('userpage.user_blank')->with('error','Oops ! Có gì đó đã xảy ra và chúng mình không thể tạo bài viết cho bạn. Hãy báo cáo nếu bạn có vấn đề cho đội ngũ Bóng Đèn nhé.');
      }

      return view('userpage.user_blank')->with('success','Chúc mừng bạn đã tạo bài viết thành công. Bóng đèn lại sáng hơn nữa rồi !!!');
    }

    public function delete(Request $request){
      $article_id = $request->article_id;
      $err = ArticleService::delete($article_id);
      return $err;
    }
}
