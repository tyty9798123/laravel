<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ["name"];

    use HasFactory;

    public function products(){
        //return $this->belongsToMany(Product::class);
        return $this->belongsToMany(Product::class, 'product_tag', 'tag_id', 'product_id');

    }
}
