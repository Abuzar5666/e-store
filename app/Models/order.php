<?php

namespace App\Models;

use App\Mail\orderTimeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $guarded=[];
    
    public function orderItems(){
        return $this->hasMany(order_item::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
  
}
