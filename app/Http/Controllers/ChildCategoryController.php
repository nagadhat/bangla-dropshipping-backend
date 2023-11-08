<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Validator;

class ChildCategoryController extends Controller
{
    public function index(){

    }

    public function store(Request $request){

        $validation = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'child_category_name' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->messages()
            ]);
        }else{

            $child_category = ChildCategory::create([
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->child_category_name
            ]);
            if($child_category){
                return response()->json([
                    'massage' => 'Child-Category Created Successfully',
                ]);
            }else{
                return response()->json([
                    'error' => 'Something went wrong',   
                ]);
            }
        }
    }
}
