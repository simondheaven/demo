<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
      'post_id',
      'value',
      'user_id'
    ];
}
