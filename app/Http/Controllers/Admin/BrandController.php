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
                'description' => 'required'
                
            ]);
    
            if($validation->fails()){
                // return $validation->massages();
                return redirect()->route('add_brand')->with('message', 'Please Fillup Required Fields');
    
            }else{

                $brand = Brand::create([
                    'name' => $request->name,
                    'description' =>  $request->description,
                
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
}
