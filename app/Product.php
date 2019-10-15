<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'status', 'quantity', 'color', 'features', 'slug', 'price', 'image'];


    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }

    public function brand(){
        return $this->hasOne('App\Brand','id','brand_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class,'product_id','id');
    }


}
