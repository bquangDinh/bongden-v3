<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ArticleService;
use App\Http\Services\UserAchievementService;
use App\Http\Services\FileService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\ChangingPasswordRequest;

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

    public function show_article_approving(){
      if(Auth::user()->hasRole('content_executive')){
        $articles = ArticleService::get_pending_article();
        return view('userpage.user_article_approving_page')->with('articles',$articles);
      }

      return view('userpage.user_blank')->with('error','Bạn không có quyền để truy cập tính năng này');
    }

    public function show_user_profile(){
      if(Auth::check()){
        return view('userpage.user_profile_page');
      }

      return "Who are you ???? What are you doing here ????";
    }

    public function show_user_changing_password(){
      if(Auth::check()){
        return view('userpage.user_changing_password_page');
      }

      return "Who are you ???? What are you doing here ????";
    }

    public function set_avatar_with_url(Request $request){
      $url = $request->avatarURL;
      $user = Auth::user();
      $user->avatarURL = $url;
      $user->save();
      return 0;
    }

    public function set_avatar_with_file(Request $request){
      $validation = Validator::make($request->all(),[
        'avatarFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      if($validation->passes()){
        $file = $request["avatarFile"];
        $image = FileService::upload_image($file,Auth::user()->id);

        $user = Auth::user();
        $user->avatarURL = $image->url;
        $user->save();
        return $image->url;
      }

      return -1;
    }

    public function update_profile(Request $request){
      if(Auth::check()){
        UserService::update_profile($request);
        return redirect()->back();
      }

      return redirect()->to('/');
    }

    public function update_password(ChangingPasswordRequest $request){
      if(Auth::check()){
        $err = UserService::update_password($request);

        if($err == -1){
          return view('userpage.user_changing_password_page')->with('error','Vui lòng nhập đúng mật khẩu');
        }else{
          return view('userpage.user_blank')->with('success','Cập nhật mật khẩu thành công');
        }
      }else{
        return redirect()->to('/');
      }
    }
}
