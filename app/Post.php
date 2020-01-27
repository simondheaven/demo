<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      "user_id",
      "post_type",
      "text_content",
      "link_url",
      "link_title",
      "link_image",
      "link_description"
    ];

    public function user(){
      return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function images(){
      return $this->hasMany('\App\ImageUpload', 'post_id', 'id');
    }

    public function votes(){
      return $this->hasMany('\App\Vote', 'post_id', 'id');
    }
}
