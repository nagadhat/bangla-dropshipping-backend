<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ChildCategoryController extends Controller
{
    public function index(){}

    /**
   * @OA\Post(
   * path="/api/add/child-category",
   * operationId="Store Child-Category",
   * tags={"Add Child-Category"},
   * summary="Child-Category Add",
   * description="Adding child-category according to sub-category",
   *     @OA\RequestBody(
   *         @OA\JsonContent(),
   *         @OA\MediaType(
   *            mediaType="multipart/form-data",
   *            @OA\Schema(
   *               type="object",
   *               required={"child_category_name","sub_category_id"},
   *               @OA\Property(property="sub_category_id", type="text"),
   *               @OA\Property(property="child_category_name", type="text"),
   *            ),
   *        ),
   *    ),
   *      @OA\Response(
   *          response=201,
   *          description="Sub-Category Inserted Successfully",
   *          @OA\JsonContent()
   *       ),
   *      @OA\Response(
   *          response=200,
   *          description="Sub-Category Inserted Successfully",
   *          @OA\JsonContent()
   *       ),
   *      @OA\Response(
   *          response=422,
   *          description="Unprocessable Entity",
   *          @OA\JsonContent()
   *       ),
   *      @OA\Response(response=400, description="Bad request"),
   *      @OA\Response(response=404, description="Resource Not Found"),
   * )
   */

   public function store(Request $request){

       $validation = Validator::make($request->all(), [
           'sub_category_id' => 'required',
           'child_category_name' => 'required',
       ]);
       if($validation->fails()){
           return response()->json([
               'error' => $validation->messages()
           ]);
       }else{

           $child_category = ChildCategory::create([
               'sub_category_id' => $request->sub_category_id,
               'name' => $request->child_category_name
           ]);
           if($child_category){
               return response()->json([
                   'massage' => 'Child-Category Created Successfully',
               ]);
           }else{
               return response()->json([
                   'error' => 'Something went wrong',   
               ]);
           }
       }
   }
}
