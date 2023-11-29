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

    // public function sub_category(){
    //     return $this->hasMany(SubCategory::class);
    // }

    // public function child_categories(){
    //     return $this->hasManyThrough(ChildCategory::class, SubCategory::class);
    // }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public static function categoryTree(){

        $allCategories = Category::all();
        $rootCategories = $allCategories->whereNull('parent_id');

        self::formateTree($rootCategories, $allCategories);
        
        return $rootCategories;

    }
    private static function formateTree($categories, $allCategories){
        foreach($categories as $category){
            $category->children = $allCategories->where('parent_id', $category->id)->values();

            if($category->children->isNotEmpty()){
                self::formateTree($category->children, $allCategories);
            }
        }
    }
    public function parentCategory(){
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }
    public function subCategories(){
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
    public static function getCategories(){
        $getCategories = Category::with(['subCategories' => function($query){
            $query->with('subCategories');
        }])->get();
        return $getCategories;
    }
    public function isChild(){
        return $this->parent_id != null;
    }
}
