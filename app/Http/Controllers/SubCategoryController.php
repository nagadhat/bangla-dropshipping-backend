<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Validator;

class SubCategoryController extends Controller
{
    public function index($id){

        $sub_categories = SubCategory::where('category_id', $id)->get();

        if($sub_categories){
            return response()->json([
                'data' => $sub_categories
            ]);
        }else{
            return response()->json([
                'data' => 'Something went wrong'
            ]);
        }
    }
    public function store(Request $request){

        $validation = Validator::make($request->all(), [
            'category_id' => 'required',
            'category_name' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->messages()
            ]);
        }else{

            $sub_category = SubCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->category_name
            ]);
            if($sub_category){
                return response()->json([
                    'massage' => 'Sub-Category Created Successfully',
                ]);
            }else{
                return response()->json([
                    'error' => 'Something went wrong',   
                ]);
            }
        }
    }
}
