<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Category;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id'];

    public function sub_category(){
        return $this->hasMany(SubCategory::class);
    }

    public function child_categories(){
        return $this->hasManyThrough(ChildCategory::class, SubCategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
