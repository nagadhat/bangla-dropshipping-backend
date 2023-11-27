<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Validator;
use File;

class CategoryController extends Controller
{
     /**
     * @OA\Get(
     *      path="api/categories",
     *      operationId="Category-index",
     *      tags={"Fetch Category"},
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
    * operationId="Store Category",
    * tags={"Add Category"},
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
            'icon' => 'nullable|mimes:png,jpg,jpeg,svg'
            
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->massages(),
            ]);

        }else{
            $image = $request->file('icon');
            // upload image to folder
            if( $request->has('icon')){
                $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                $image_folder = public_path('/images/category-images');
                $image->move($image_folder, $image_name);

                $image_path = url('/images/category-images'.'/'.$image_name);
            }
            $category = Category::create([
                'name' => $request->name,
                'image' =>  $image_path
            
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

     /**
    * @OA\Put(
    * path="/api/update/category/{id}",
    * operationId="update Category",
    * tags={"Update Category"},
    * summary="Category update",
    * description="Updating category fields here",
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
    *          description="Category Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Category Updated Successfully",
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

    public function update(Request $request, $id){

        $category = Category::where('id', $id)->first();
        
        $validation = Validator::make( $request->all(), [
            'name' => 'required|max:150',
            'icon' => 'nullable|mimes:png,jpg,jpeg,svg'
        ]); 

        if($validation->fails()){
            return response()->json([
                'error' => $validation->massages(),
            ]);

        }else{
            $image = $request->file('icon');
            // upload image to folder
            if( $request->has('icon')){
                $image_name = time().rand().'.'. $image->getClientOriginalExtension();
                $image_folder = public_path('/images/category-images');
                $image->move($image_folder, $image_name);

                // delete old image from folder
                $image_old = pathinfo($category->image, PATHINFO_BASENAME);
                $image_old_path = public_path('/images/category-images'.'/'.$image_old);
                if(File::exists($image_old_path)){
                    File::delete($image_old_path);
                }
                // end of delete old image from folder

                $image_path = url('/images/category-images'.'/'.$image_name);
            }
            // end of image upload to folder

            $category -> update([
                'name' => $request->name,
                'image' => $image_path
            ]);      

            if($category){
                return response()->json([
                    'massage' => 'Category Updated Successfully',
                    'data' => $category
                ]);

            }else{
                return response()->json([
                    'massage' => 'Something went wrong'
                ]);
            }
        }
    }

     /**
    * @OA\Delete(
    * path="/api/delete/category/{id}",
    * operationId="Delete Category",
    * tags={"Delete Category"},
    * summary="Category deleted",
    * description="Delete record according to id from category table",
    *      @OA\Response(
    *          response=201,
    *          description="Category Deleted Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Category Deleted Successfully",
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

    public function delete($id){
        $category = Category::where('id', $id)->first();

        if($category){
            $category->delete();

             // delete old image from folder
             $image_old = pathinfo($category->image, PATHINFO_BASENAME);
             $image_old_path = public_path('/images/category-images'.'/'.$image_old);
             if(File::exists($image_old_path)){
                 File::delete($image_old_path);
             }
             // end of delete old image from folder

            return response()->json([
                'massage' => 'Category Deleted Successfully',
                
            ]);
        }else{
            return response()->json([
                'massage' => 'Something went wrong'
            ]);
        }
    }
    public function get_all_categories(){

        $category = Category::categoryTree();

        if($category){
            return response()->json([
                'category' => $category,
    
            ]);
        }else{
            return response()->json([
                'error' => 'Something went wrong',
    
            ]);
        }
        
    }
}