<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }

    // public function getPriceAttribute()
    // {
    //     // format number with two decimals and thousand separators
    //     $formatted = number_format($this->attributes['price'], 2);

        
    //     return  $formatted;
    // }
}
