<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function get_sliders(){

        $slider = Slider::orderBy('id', 'DESC')->get();

        if($slider){
            return response()->json([
                'slider' => $slider,
    
            ]);
        }else{
            return response()->json([
                'error' => 'Something went wrong',
    
            ]);
        }
    }
}
