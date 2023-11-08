<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class ChildCategory extends Model
{
    use HasFactory;

    protected $table = 'child_categories';

    protected $guarded = ['id'];

    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }
    
}
