<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Validator;


class ChildCategoryController extends Controller
{
    public function index(){
        $child_categories = ChildCategory::with('sub_category')->orderBy('id', 'DESC')->get();
        return view('back-end.child_category.child_categories', compact('child_categories'));
    }
    public function store(Request $request){

        // check method
        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'name' => 'required|max:150',
                'sub_category_id' => 'required',
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_child_category')->with('message', 'Please Fillup Required Fields');
    
            }else{

                $slug = Str::slug($request->name, '-');
                $child_category = ChildCategory::create([
                    'name' => $request->name,
                    'sub_category_id' => $request->sub_category_id,
                    'slug' => $slug

                
                ]);
                if($child_category){
                return redirect()->route('get_child_categories')->with('message', 'Child-Category Created Successfully');

                }else{
                    return redirect()->route('add_child_category')->with('message', 'Something went wrong');
                }
            }
        }else {
            
            $sub_categories = SubCategory::all();
            return view('back-end.child_category.create_child_category', compact('sub_categories'));
        }
    }
}
