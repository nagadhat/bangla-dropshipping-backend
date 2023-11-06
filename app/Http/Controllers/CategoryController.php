<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use File;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();
        if($categories){
            return response()->json([
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'message' => 'Something went wrong'
            ]);
        }

    }

    public function store(Request $request){

        $validation = Validator::make( $request->all(), [
            'name' => 'required|max:150',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->massages(),
            ]);

        }else{
            $image = $request->file('cat_image');

            if( $request->has('cat_image')){
                $image_name = rand(). $image->getClientOriginalName();
                $image_folder = public_path('/images/category-images');
                $image->move($image_folder, $image_name);

                $image_path = url('/images/category-images'.'/'.$image_name);
            }
            $category = Category::create([
                'name' => $request->name,
                'image' =>  $image_path
            ]);
            if($category){
                return response()->json([
                    'massage' => 'Category Inserted Successfully'
                ]);

            }else{
                return response()->json([
                    'massage' => 'Something went wrong'
                ]);
            }
        }
    }
}
