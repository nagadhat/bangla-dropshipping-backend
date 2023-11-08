<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ChildCategory;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function child_category(){
        return $this->hasMany(ChildCategory::class);
    }
}
