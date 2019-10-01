<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeUnlike extends Model
{


    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }


}
