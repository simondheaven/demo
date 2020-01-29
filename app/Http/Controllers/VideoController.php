<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Post;

class VideoController extends Controller
{
  public function store(Request $request, Post $post)
  {

    $base_path = public_path().'\\videos';

    //check videos folder exists
    if(!file_exists($base_path)){
      mkdir($base_path, '777', true);
    }

    //create base folder
    $base_path .= '\\'.$post->id;
    if(!file_exists($base_path)){
      mkdir($base_path, '777', true);
    }
    $base_path .= '\\';

    //store original video
    $video = $request->file('file');
    $videoName = $video->getClientOriginalName();
    $video->move($base_path,$videoName);
    $path_original = $base_path.$videoName;

    //create database entry
    $video = Video::create([
      'user_id' => \Auth::user()->id,
      'post_id' => $post->id,
      'base_path' => $base_path,
      'path_original' => $path_original
    ]);

    return $video;
  }

  public function convertMP4(Request $request){
    $post = Post::find($request->post_id);
    $video = $post->video()->first();
    $ffmpeg = base_path().'/app/Helpers/ffmpeg64/bin/ffmpeg.exe';
    $outputFile = $video->base_path.'\\video.mp4';
    $batch = public_path().'\\videos\\'.$post->id.'\\'.$post->id.'.bat';

    $handle = fopen($batch, 'w');
    $comm = 'start /b "title" "'.$ffmpeg.'" -i ';
    //$comm = 'nohup "'.$ffmpeg.'" -i ';
    $comm .= '"'.$video->path_original.'" ';
    $comm .= '"'.$outputFile.'" ';
    $comm .= ' && cd "'.base_path().'" && php artisan video '.$video->id;
    $video->path_mp4 = $outputFile;
    $comm .= ' && ';
    $outputFile = $video->base_path.'\\video.ogg';
    $comm .= '"'.$ffmpeg.'" -i ';
    $comm .= '"'.$video->path_original.'" ';
    $comm .= '"'.$outputFile.'" ';
    $comm .= ' && cd "'.base_path().'" && php artisan video '.$video->id;
    $video->path_ogg = $outputFile;
    $comm .= ' && ';
    $outputFile = $video->base_path.'\\video.webm';
    $comm .= '"'.$ffmpeg.'" -i ';
    $comm .= '"'.$video->path_original.'" ';
    $comm .= '"'.$outputFile.'" ';
    $comm .= ' && cd "'.base_path().'" && php artisan video '.$video->id;
    $video->path_webm = $outputFile;
    $video->save();
    fwrite($handle, $comm);
    fwrite($handle,PHP_EOL);
    fwrite($handle,"EXIT");
    fclose($handle);

    pclose(popen( "start /b ". $batch, "r"));
    return response()->json([
      "success" => $comm
    ]);
  }

  /*public function convertOgg(Request $request){
    $post = Post::find($request->post_id);
    $video = $post->video()->first();
    $ffmpeg = base_path().'/app/Helpers/ffmpeg64/bin/ffmpeg.exe';
    $outputFile = $video->base_path."\\video.ogg";
    $comm .= '"'.$ffmpeg.'" -i ';
    $comm .= '"'.$video->path_original.'" ';
    $comm .= '"'.$outputFile.'" ';
    $comm .= ' && cd "'.base_path().'" && php artisan video '.$video->id;
    $video->path_ogg = $outputFile;
    $video->save();
    exec($comm);
    return response()->json([
      "success" => $comm
    ]);
  }

  public function convertWebm(Request $request){
    $post = Post::find($request->post_id);
    $video = $post->video()->first();
    $ffmpeg = base_path().'/app/Helpers/ffmpeg64/bin/ffmpeg.exe';
    $outputFile = $video->base_path."\\video.webm";
    $comm .= '"'.$ffmpeg.'" -i ';
    $comm .= '"'.$video->path_original.'" ';
    $comm .= '"'.$outputFile.'" ';
    $comm .= ' && cd "'.base_path().'" && php artisan video '.$video->id;
    $video->path_webm = $outputFile;
    $video->save();
    exec($comm);
    return response()->json([
      "success" => $comm
    ]);
  }*/

  public function areWeNearlyThereYet(Request $request){
    $post = Post::find($request->post_id);
    $video = $post->video()->first();
    if($video->converted == 1){
      return response()->json([
        'success' => 1,
        'converted' => 1,
        'video' => $video,
        'post' => Post::where('id',$request->post_id)->with('video')->first()
      ]);
    } else {
      return response()->json([
        'success' => 1,
        'converted' => 0,
        'conversion_progress' => $video->conversion_progress
      ]);
    }
  }
}
