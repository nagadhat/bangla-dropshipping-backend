<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get_all_categories(){

        $category = Category::with('sub_category.child_category')->get();

        if($category){
            return response()->json([
                'category' => $category,
    
            ]);
        }else{
            return response()->json([
                'error' => 'Something went wrong',
    
            ]);
        }
        
    }
}
