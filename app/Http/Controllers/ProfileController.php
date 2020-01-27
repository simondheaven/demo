<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfilePic(Request $request){
      $imageIDs = explode(",",$request->fileIDs);
      $user = \App\User::find(\Auth::user()->id);
      foreach($imageIDs as $iid){
        $user->profilePic()->delete();
        $img = \App\ImageUpload::find($iid);
        $img->isProfilePic = 1;
        $img->save();
        $user->profile_pic = $img->id;
        $user->save();
      }
      return redirect()->back();
    }
}
