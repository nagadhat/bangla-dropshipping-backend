<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Validator;
use File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'DESC')->get();
        return view('back-end.product.products',compact('products'));
    }

    public function store(Request $request){
        
        // check method
        if ($request->isMethod('POST')) {
           
            // dd($request->file('images'));
            // return $request->all();
            // validation
            $validation = Validator::make( $request->all(), [
                'category_id' =>  'required',
                'sub_category_id' => 'required',
                'child_category_id' => 'required',
                'name' => 'required|max:150',
                'description' => 'required',
                'images' => 'nullable',
                'price' => 'required',
                'discoutPrice' => 'nullable',
                'colour' => 'required',
                'size' => 'required',
                'quantity' => 'required'
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_product')->with('message', $validation->messages());
                
            }else{
                $files = $request->file('images');
                // upload image to folder
                if($files){

                    foreach($files as $file){
                        $image_name = rand().'.'. $file->getClientOriginalExtension();
                        $image_path = public_path('/images/product-images');
                        $file->move($image_path, $image_name);
                        $image_url = url('/images/product-images'.'/'.$image_name);
                        $image[] =  $image_url;
                    }
                    // $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    // $image_folder = public_path('/images/product-images');
                    // $image->move($image_folder, $image_name);
    
                    // $image_path = url('/images/product-images'.'/'.$image_name);
                }
                $product = Product::create([
                    'category_id' =>  $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'child_category_id' => $request->child_category_id,
                    'name' => $request->name,
                    'description' =>  $request->description,
                    'image' => implode(',', $image),
                    'price' => $request->price,
                    'discoutPrice' =>  $request->discountPrice,
                    'colour' => json_encode($request->colour),
                    'size' => json_encode($request->size),
                    'quantity' => $request->quantity
                
                ]);
                // return $product;
                if($product){
                return redirect()->route('get_products')->with('message', 'Product Inserted Successfully');

                }else{
                    return redirect()->route('add_product')->with('message', 'Something went wrong');
                }
            }
        }else {
            $categories = Category::all();
            return view('back-end.product.create_product', compact('categories'));
        }
    }

    public function get_sub_category(Request $request){

        $cat_id = $request->category_id;
        // return $request->all();
        $sub_categories = SubCategory::where('category_id', $cat_id)->get();
        return response()->json($sub_categories);
    }

    public function get_child_category(Request $request){

        $sub_cat_id = $request->sub_category_id;
        $child_categories = ChildCategory::where('sub_category_id', $sub_cat_id)->get();
        return response()->json($child_categories);
    }
}
