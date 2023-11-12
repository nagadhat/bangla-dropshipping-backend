<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;

class SubCategoryController extends Controller
{
    public function index(){
        $sub_categories = SubCategory::with('category')->orderBy('id', 'DESC')->get();
        return view('back-end.sub_category.sub_categories', compact('sub_categories'));
    }
    public function store(Request $request){

        // check method
        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required|max:150',
                'category_id' => 'required',
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_sub_category')->with('message', 'Please Fillup Required Fields');
    
            }else{

                $sub_category = SubCategory::create([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                
                ]);
                if($sub_category){
                return redirect()->route('get_sub_categories')->with('message', 'Sub-Category Created Successfully');

                }else{
                    return redirect()->route('add_sub_category')->with('message', 'Something went wrong');
                }
            }
        }else {
            
            $categories = Category::all();
            return view('back-end.sub_category.create_sub_category', compact('categories'));
        }
    }
}
