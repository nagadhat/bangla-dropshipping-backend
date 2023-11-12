<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;
use File;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('back-end.category.categories', compact('categories'));
    }
    public function store(Request $request){

        // check method
        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required|max:150',
                'icon' => 'nullable|mimes:png,jpg,jpeg,svg',
                'priority' => 'required'
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_category')->with('message', 'Please Fillup Required Fields');
    
            }else{
                $image = $request->file('icon');
                // upload image to folder
                if( $request->has('icon')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/category-images');
                    $image->move($image_folder, $image_name);
    
                    $image_path = url('/images/category-images'.'/'.$image_name);
                }
                $category = Category::create([
                    'name' => $request->name,
                    'image' =>  $image_path,
                    'priority' =>$request->priority
                
                ]);
                if($category){
                return redirect()->route('get_categories')->with('message', 'Category Inserted Successfully');

                }else{
                    return redirect()->route('add_category')->with('message', 'Something went wrong');
                }
            }
        }else {
            return view('back-end.category.create_category');
        }
    }
}
