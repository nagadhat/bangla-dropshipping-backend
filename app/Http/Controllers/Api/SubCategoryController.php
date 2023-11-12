<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Validator;

class SubCategoryController extends Controller
{
     /**
     * @OA\Get(
     *      path="api/sub-categories",
     *      operationId="Sub-Category-index",
     *      tags={"Fetch Sub-Category"},
     *      summary="list of Sub-Categories",
     *      description="Returns list of sub-categories",
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
    public function index($id){

        $sub_categories = SubCategory::where('category_id', $id)->get();

        if($sub_categories){
            return response()->json([
                'data' => $sub_categories
            ]);
        }else{
            return response()->json([
                'data' => 'Something went wrong'
            ]);
        }
    }

    /**
    * @OA\Post(
    * path="/api/add/sub-category",
    * operationId="Store Sub-Category",
    * tags={"Add Sub-Category"},
    * summary="Sub-Category Add",
    * description="Adding sub-category according to category",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"sub_category_name","category_id"},
    *               @OA\Property(property="category_id", type="text"),
    *               @OA\Property(property="sub_category_name", type="text"),
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
            'category_id' => 'required',
            'sub_category_name' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->messages()
            ]);
        }else{

            $sub_category = SubCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->sub_category_name
            ]);
            if($sub_category){
                return response()->json([
                    'massage' => 'Sub-Category Created Successfully',
                ]);
            }else{
                return response()->json([
                    'error' => 'Something went wrong',   
                ]);
            }
        }
    }
}
