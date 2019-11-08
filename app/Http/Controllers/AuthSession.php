<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthSession extends Controller
{
  public function destroy(){
    Auth::logout();
    return redirect('/');
  }
}
