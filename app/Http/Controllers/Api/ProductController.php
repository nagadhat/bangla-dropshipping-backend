<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductController extends Controller
{
    public function index(){
    }
    public function store(Request $request){

        //  return response()->json([
        //             'valid' => auth()->check(),
        //             'message' => $request->name
        //         ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'size' => 'required',
            'colour' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);       
        }else{
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'size' => $request->size,
                'colour' => $request->colour,
            ]);

            if($product){
                return response()->json([
                    
                    'message' => 'Product inserted successfully..'
                ]);
            }else{
                return response()->json([
                    'message' => 'Something went wrong'
                ]);
            }
        }
    }
    public function get_all_products(){
        $products = Product::all();
        return response()->json([        
            'data' => $products          
        ]);
    }
}
