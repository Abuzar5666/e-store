<?php

namespace App\Models;

use App\Mail\orderTimeEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class order_item extends Model
{
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(order::class);
    }
  

    protected static function booted()
    {
        static::created(function (order_item $order){
            // $order = Order::with(['orderItems','orderItems.product'])->where('user_id', Auth::id())
            // ->orderBy('created_at', 'desc')
            // ->first();
           $order= $order->load('product');
           

        //    dd($order);

            Mail::to(Auth::user()->email)->send(new orderTimeEmail($order,'test'));
        });
    }
}
