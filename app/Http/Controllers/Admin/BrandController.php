<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Validator;

class BrandController extends Controller
{
    public function index(){

        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('back-end.brand.brands', compact('brands'));
    }
    public function store(Request $request){

        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'nullable'      
            ]);
    
            if($validation->fails()){
                // return $validation->massages();
                return redirect()->route('add_brand')->with('message', 'Please Fillup Required Fields');
    
            }else{
                $image = $request->file('icon');
                // upload image to folder
                if( $request->has('icon')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/brand-images');
                    $image->move($image_folder, $image_name);
    
                    $image_path = url('/images/brand-images'.'/'.$image_name);
                }else{
                    $image_path = null;
                }
                $brand = Brand::create([
                    'name' => $request->name,
                    'description' =>  $request->description,
                    'image' =>  $image_path,
                
                ]);
                if($brand){
                return redirect()->route('get_brands')->with('message', 'Brand Inserted Successfully');

                }else{
                    return redirect()->route('add_brands')->with('message', 'Something went wrong');
                }
            }
        }else {
            return view('back-end.brand.create_brand');
        }
    }
    public function update(Request $request, $id){

        $brand = Brand::where('id', $id)->first();

        if($request->isMethod('post')){
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'nullable'      
            ]);
    
            if($validation->fails()){
                // return $validation->massages();
                return redirect()->route('add_brand')->with('message', 'Please Fillup Required Fields');
    
            }else{
                $image = $request->file('icon');
                // upload image to folder
                if( $request->has('icon')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/brand-images');
                    $image->move($image_folder, $image_name);
    
                    $image_path = url('/images/brand-images'.'/'.$image_name);
                }else{ 
                    $image_path = $brand->image;
                }
                $brand -> update([
                    'name' => $request->name,
                    'description' =>  $request->description,
                    'image' =>  $image_path,
                
                ]);
                if($brand){
                return redirect()->route('get_brands')->with('message', 'Brand Updated Successfully');

                }else{
                    return redirect()->route('edit_brands')->with('message', 'Something went wrong');
                }
            }

        }else{
            
            return view('back-end.brand.edit_brand', compact('brand'));
        }
    }
    public function changeStatus($id){
        $brand = Brand::find($id);
        if($brand->status == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $brand->update([
            'status' => $status
        ]);
        if($brand){
            return redirect()->route('get_brands');
        }else{
            return redirect()->route('get_brands')->with('message', 'Something went wrong');
        }
    }
}
