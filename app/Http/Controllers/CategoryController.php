<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use File;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="api/categories",
     *      operationId="Category-index",
     *      tags={"Category list"},
     *      summary="list of Categories",
     *      description="Returns list of categories",
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
    public function index(){
        $categories = Category::all();
        if($categories){
            return response()->json([
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'message' => 'Something went wrong'
            ]);
        }

    }

    /**
    * @OA\Post(
    * path="/api/add/category",
    * operationId="Stor Category",
    * tags={"Category"},
    * summary="Category Add",
    * description="Adding new category here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name"},
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="icon", type="file"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Category Inserted Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Category Inserted Successfully",
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

        $validation = Validator::make( $request->all(), [
            'name' => 'required|max:150',
            // 'image' => 'nullable|mimes:png,jpg,jpeg,svg'
            'icon' => 'nullable'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->massages(),
            ]);

        }else{
            // $image = $request->file('icon');
            // // upload image to folder
            // if( $request->has('icon')){
            //     $image_name = time().rand().'.'. $image->getClientOriginalExtension();
            //     $image_folder = public_path('/images/category-images');
            //     $image->move($image_folder, $image_name);

            //     $image_path = url('/images/category-images'.'/'.$image_name);
            // }
            $category = Category::create([
                'name' => $request->name,
                // 'image' =>  $image_path
                'image' => $request->icon
            ]);
            if($category){
                return response()->json([
                    'massage' => 'Category Inserted Successfully'
                ]);

            }else{
                return response()->json([
                    'massage' => 'Something went wrong'
                ]);
            }
        }
    }
}
