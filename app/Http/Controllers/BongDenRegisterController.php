<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;

use Auth;

class BongDenRegisterController extends Controller
{
  public function __construct(){
    $this->middleware('guest');
  }

  public function index(){
    return view('auth.login');
  }

  public function register(RegisterRequest $request){
    $user = UserService::create_with_request($request);

    Auth::login($user);
    return redirect()->route('user_dashboard');
  }
}
