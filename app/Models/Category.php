<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\SubCategory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id'];

    public function sub_category(){
        return $this->hasMany(SubCategory::class);
    }
}
