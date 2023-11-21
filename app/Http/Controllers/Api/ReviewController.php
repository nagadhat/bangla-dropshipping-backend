<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Validator;

class ReviewController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'review' => 'required',
            'rating' => 'nullable',
        ]);
        if($validator->fails()){

            return response()->json([
                'error' => $validator->massages()
            ]);

        }else{
            $review = Review::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'review' => $request->review,
                'rating' => $request->rating,

            ]);
            if($review){
                return response()->json([
                    'massage' => 'Review posted successfully'
                ]);

            }else{
                return response()->json([
                    'massage' => 'Something went wrong'
                ]);  
            }
        }
    }
}
