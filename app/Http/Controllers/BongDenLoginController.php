<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BongDenLoginController extends Controller
{
  public function index(){
    return view('auth.login');
  }

  public function login(Request $request){
    $userData = array(
      'email' => $request->email,
      'password' => $request->password
    );

    if(Auth::attempt($userData)){
      if($request->has('previous')){
        return redirect()->to($request->previous);
      }

      return redirect()->intended('/user');
    }

    return redirect()->to('/bongden_login?initform=login')->withErrors(array(
      'auth' => 'The user name or password is incorrect'
    ));
  }
}
