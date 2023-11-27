<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;
use File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('back-end.category.categories', compact('categories'));
    }
    public function store(Request $request){

        // check method
        if ($request->isMethod('POST')) {
            // return $request->all();
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required',
                'icon' => 'nullable|mimes:png,jpg,jpeg,svg',
                'priority' => 'required',
                'parent_category' => 'nullable',
                
            ]);
    
            if($validation->fails()){
                // return $validation->massages();
                return redirect()->route('add_category')->with('message', 'Please Fillup Required Fields');
    
            }else{
                // if($request->parent_category)
                $image = $request->file('icon');
                // upload image to folder
                if( $request->has('icon')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/category-images');
                    $image->move($image_folder, $image_name);
    
                    $image_path = url('/images/category-images'.'/'.$image_name);
                }else{
                    $image_path = null;
                }
                $slug = Str::slug($request->name, '-');

                $category = Category::create([
                    'parent_id' => $request->parent_category,
                    'name' => $request->name,
                    'image' =>  $image_path,
                    'priority' => $request->priority,
                    'slug' =>  $slug
                
                ]);
                if($category){
                return redirect()->route('get_categories')->with('message', 'Category Inserted Successfully');

                }else{
                    return redirect()->route('add_category')->with('message', 'Something went wrong');
                }
            }
        }else {

            $categories = Category::categoryTree();
            return view('back-end.category.create_category', compact('categories'));
        }
    }
    public function update(Request $request,$id){
        // return $id;
        $category = Category::where('id', $id)->first();

        if ($request->isMethod('POST')){
            // return $request->all();
            $validation = Validator::make( $request->all(), [
                'name' => 'required|max:150',
                'icon' => 'nullable|mimes:png,jpg,jpeg,svg',
                'priority' => 'required'
            ]); 
    
            if($validation->fails()){
                return response()->json([
                    'error' => $validation->massages(),
                ]);
    
            }else{
                $image = $request->file('icon');
                // upload image to folder
                if( $request->has('icon')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/category-images');
                    $image->move($image_folder, $image_name);
    
                    // delete old image from folder
                    $image_old = pathinfo($category->image, PATHINFO_BASENAME);
                    $image_old_path = public_path('/images/category-images'.'/'.$image_old);
                    if(File::exists($image_old_path)){
                        File::delete($image_old_path);
                    }
                    // end of delete old image from folder
    
                    $image_path = url('/images/category-images'.'/'.$image_name);
                }
                // end of image upload to folder

                $slug = Str::slug($request->name, '-');
                $category -> update([
                    'name' => $request->name,
                    'image' => $image_path,
                    'priority' => $request->priority,
                    'slug' => $slug
                ]);      
    
                if($category){

                    return redirect()->route('get_categories')->with('message', 'Category Updated Successfully');
                    
                }else{
                    return redirect()->route('get_categories')->with('message', 'Something went wrong');

                }
            }

        }else{
            // return $id;
            return view('back-end.category.edit_category', compact('category'));
        }
    }
    public function delete($id){
    
        $category = Category::where('id', $id)->first();

        if($category){
            $category->delete();

             // delete old image from folder
             $image_old = pathinfo($category->image, PATHINFO_BASENAME);
             $image_old_path = public_path('/images/category-images'.'/'.$image_old);
             if(File::exists($image_old_path)){
                 File::delete($image_old_path);
             }
             // end of delete old image from folder

            return redirect()->route('get_categories')->with('message', 'Category deleted successfully');
        }else{
            return redirect()->route('get_categories')->with('message', 'Something went wrong');

        }

    }
}
