<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('video {id}', function($id){
  $vid = \App\Video::find($id);
  $vid->conversion_progress = $vid->conversion_progress + 33;
  $vid->save();
  if($vid->conversion_progress == 99){
    $vid->conversion_progress = 100;
    $vid->converted = 1;
    $vid->save();
    @unlink($vid->path_original);
    @unlink($vid->base_path.$vid->post_id.'.bat');
  }
})->describe('Update vid processed');
