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

        $product = Product::with('category')->get();

        if($product){
            return response()->json([
                'product' => $product,
    
            ]);
        }else{
            return response()->json([
                'error' => 'Something went wrong',
    
            ]);
        }
        
    }
    public function get_product($id){

        $product = Product::find($id);
        if($product){
            return response()->json([        
                'data' => $product          
            ]);
        }else{
            return response()->json([        
                'massage' => 'Something went wrong'         
            ]);
        }
    }

    public function products_by_category($slug, $id){

        $products = Product::where('category_id', $id)->get();
        if($products){
            return response()->json([
                'data' => $products
            ]);
        }else{
            return response()->json([
                'massage' => 'Something went wrong'
            ]);
        }
        
    }

    public function products_by_subcategory($slug, $id){

        $products = Product::where('sub_category_id', $id)->get();
        if($products){
            return response()->json([
                'data' => $products
            ]);
        }else{
            return response()->json([
                'massage' => 'Something went wrong'
            ]);
        }
    }

    public function products_by_childcategory($slug, $id){

            $products = Product::where('child_category_id', $id)->get();
            if($products){
                return response()->json([
                    'data' => $products
                ]);
            }else{
                return response()->json([
                    'massage' => 'Something went wrong'
                ]);
            }
    }
   
}
