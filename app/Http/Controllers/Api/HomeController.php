<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Product;

class HomeController extends Controller
{
     /**
     * @OA\Get(
     *      path="api/get-all-categories",
     *      operationId="get-all-categories",
     *      tags={"Fetch categories with their sub-categories and child categories"},
     *      summary="list of all Categories",
     *      description="Returns list of categories with their sub-categories and child categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
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
        return response()->json([        
            'data' => $products          
        ]);
    }
}
