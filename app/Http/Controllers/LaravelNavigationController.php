<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaravelNavigationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(){
    return view('laravel.dashboard');
  }

  public function profile(){
    $user = \Auth::user();
    return view('laravel.profile', ['user' => $user]);
  }

  public function otherProfile($id){
    $user = \App\User::find($id);
    return view('laravel.profile', ['user' => $user]);
  }

  public function about(){
    return view('laravel.about');
  }
}
