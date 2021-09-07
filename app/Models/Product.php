<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Class_;

class Product extends Model
{
    protected $fillable = ["name", "price", "image_url", "brand_name", "category_name"];
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
        //return DB::table('categories')->where('id', $this->category_id)->first();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
