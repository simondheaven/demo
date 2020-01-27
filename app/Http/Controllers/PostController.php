<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\ImageUpload;

class PostController extends Controller
{
    public function create(Request $request){
      if($request->post_type == "TEXT"){
        $post = Post::create([
          'user_id' => \Auth::user()->id,
          'post_type' => $request->post_type,
          'text_content' => $request->text_content
        ]);
      } else if($request->post_type == "IMAGE"){
        if($request->fileIDs == ""){
          return redirect()->back();
        }
        $post = Post::create([
          'user_id' => \Auth::user()->id,
          'post_type' => $request->post_type,
          'text_content' => ($request->text_content == null) ? "" : $request->text_content
        ]);
        $imageIDs = explode(",",$request->fileIDs);
        foreach($imageIDs as $iid){
          $img = ImageUpload::find($iid);
          $img->post_id = $post->id;
          $img->save();
        }
        $userImgs = ImageUpload::where('user_id',\Auth::user()->id)->where('post_id', 0)->where('isProfilePic',0)->get();
        foreach($userImgs as $img){
          @unlink(public_path().'/images/'.$img->filename);
          $img->delete();
        }
      } else if($request->post_type == "VIDEO"){
        $post = Post::create([
          'user_id' => \Auth::user()->id,
          'post_type' => $request->post_type
        ]);
      } else if($request->post_type == "LINK"){
        $post = Post::create([
          'user_id' => \Auth::user()->id,
          'post_type' => $request->post_type,
          'link_url' => $request->link_url,
          'text_content' => $request->text_content
        ]);
      }
      return redirect()->back();
    }

    public function timelineUpdate(Request $request){
      return Post::skip($request->loadedPosts)
                  ->orderBy('created_at','DESC')
                  ->take(20)
                  ->with('images')
                  ->with('votes')
                  ->with('user.profilePic')
                  ->get();
    }

    public function doot(Request $request){
      $doot = \App\Vote::where('post_id',$request->post_id)
                        ->where('user_id', \Auth::user()->id)
                        ->get();
      $predootval = 0;
      foreach($doot as $dt){
        $predootval = $dt->value;
        $dt->delete();
      }
      $postdootval = 0;
      if($request->doot_value != $predootval){
        $postdootval = $request->doot_value;
        \App\Vote::create([
          'post_id' => $request->post_id,
          'user_id' => \Auth::user()->id,
          'value' => $request->doot_value
        ]);
      }
      $postTotal = \App\Vote::where('post_id',$request->post_id)->where('value',1)->count();
      $postTotal -= \App\Vote::where('post_id',$request->post_id)->where('value',-1)->count();
      return response()->json([
        'post_id' => $request->post_id,
        'post_total' => $postTotal,
        'doot_value' => $postdootval
      ]);
    }

    public function updateLink(Request $request){
      $post = Post::find($request->post_id);
      $post->link_title = $request->link_title;
      $post->link_image = $request->link_image;
      $post->link_description = $request->link_description;
      $post->save();
      return $post;
    }
}
