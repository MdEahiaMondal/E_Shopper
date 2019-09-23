<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   public function user(){
       return $this->belongsTo(User::class,'user_id');
   }

   public function shipping(){
       return $this->hasOne(Shipping::class,'id');
   }

   public function order_details(){
       return $this->hasMany(Order_details::class,'order_id');
   }

    /*protected static function boot() {
        parent::boot();
        static::deleting(function($order) { //when delete order first use find(id) and store into $order.
             $order->order_details()->delete();
            $order->shipping()->delete();
        });
    }*/
}
