<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\ImageUpload;

class ImageUploadController extends Controller
{

  public function __construct() {
      $this->middleware('auth');
  }

  public function fileStore(Request $request) {
      $image = $request->file('file');
      $imageName = $image->getClientOriginalName();
      $image->move(public_path('images'),$imageName);

      $imageUpload = new ImageUpload();
      $imageUpload->filename = $imageName;
      $imageUpload->user_id = \Auth::user()->id;
      $imageUpload->save();
      return response()->json(['success'=>$imageUpload->id]);
  }

  public function fileDestroy(Request $request) {
        $filename =  $request->get('filename');
        ImageUpload::where('filename',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            @unlink($path);
        }
        return $filename;
    }
}
