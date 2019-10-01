<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function likeDislike(){
        return $this->hasMany(LikeUnlike::class);
    }

}
