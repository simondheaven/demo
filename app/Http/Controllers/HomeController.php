<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    public function laravel(){
      if(\Auth::check()){
          return $this->index();
      } else {
        return view('laravel.home');
      }
    }

    public function index(){
      $navCon = new \App\Http\Controllers\LaravelNavigationController();
      return $navCon->index();
    }
}
