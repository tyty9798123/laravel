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

    // public function category(){
    //     return $this->belongsTo(Category::class);
    //     //return DB::table('categories')->where('id', $this->category_id)->first();
    // }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function categoriesList(){
        $categories = [];
        $temp = $this->category;
        while(!is_null($temp)){
            array_unshift($categories, $temp);
            $temp = $temp->parent;
        }
        return $categories;
    }

    public function category() { 
        return $this->hasOneThrough(Category::class, Subcategory::class, 'id', 'id', 'subcategory_id', 'category_id');
    }
}
