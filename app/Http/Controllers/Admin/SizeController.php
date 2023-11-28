<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Validator;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::orderBy('id', 'desc')->get();
        return view('back-end.variants.sizes', compact('sizes'));
    }
    public function store(Request $request){

        // check method
        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required|max:150',
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_size')->with('message', 'Please Fillup Required Fields');
    
            }else{

                // $slug = Str::slug($request->name, '-');
                $size = Size::create([
                    'name' => $request->name,
                    
                ]);
                if($size){
                return redirect()->route('get_sizes')->with('message', 'Size Inserted Successfully');

                }else{
                    return redirect()->route('add_size')->with('message', 'Something went wrong');
                }
            }
        }else {
            
            // $sub_categories = SubCategory::all();
            return view('back-end.variants.add_size');
        }
    }
}
