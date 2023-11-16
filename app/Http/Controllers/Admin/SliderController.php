<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;
use File;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('back-end.slider.sliders', compact('sliders'));
    }
    public function store(Request $request){

        if ($request->isMethod('POST')) {
            // validation
            $validation = Validator::make( $request->all(), [
                'title' => 'required|max:150',
                'image' => 'required|mimes:png,jpg,jpeg,svg',
                
            ]);
    
            if($validation->fails()){
                return redirect()->route('add_slider')->with('message', 'Please Fillup Required Fields');
    
            }else{
                $image = $request->file('image');
                // upload image to folder
                if( $request->has('image')){
                    $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                    $image_folder = public_path('/images/slider-images');
                    $image->move($image_folder, $image_name);
    
                    $image_path = url('/images/slider-images'.'/'.$image_name);
                }
                $slider = Slider::create([
                    'title' => $request->title,
                    'image' =>  $image_path,
                    
                ]);
                if($slider){
                return redirect()->route('get_sliders')->with('message', 'Slider Image Inserted Successfully');

                }else{
                    return redirect()->route('add_slider')->with('message', 'Something went wrong');
                }
            }
        }else {
            return view('back-end.slider.create_slider');
        }
    }
}
