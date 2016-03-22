<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stars extends Model
{

	public $timestamps  = false;

    public function author()
  {
    return $this->belongsToMany('App\User','author_id');
  }

   public function post()
  {
    return $this->belongsToMany('App\Posts','on_post');
  }
  
}
