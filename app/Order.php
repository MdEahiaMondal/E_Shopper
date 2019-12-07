<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'payment_id', 'total', 'status',
    ];

   public function user(){
       return $this->belongsTo(User::class,'user_id');
   }

   public function shipping(){
       return $this->hasOne(Shipping::class);
   }

   public function order_details(){
       return $this->hasMany(Order_details::class,'order_id');
   }

   public function payment(){
       return $this->belongsTo(Payment::class);
   }

    /*protected static function boot() {
        parent::boot();
        static::deleting(function($order) { //when delete order first use find(id) and store into $order.
             $order->order_details()->delete();
            $order->shipping()->delete();
        });
    }*/
}
