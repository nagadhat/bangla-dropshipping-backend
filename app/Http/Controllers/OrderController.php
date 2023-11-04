<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderRepositoryInterface;
use App\Http\Controllers\BaseController;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class OrderController extends BaseController
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): JsonResponse 
    {
        return response()->json([
            'data' => $this->orderRepository->getAllOrders()
        ]);
    }
    /**
    * @OA\Post(
    * path="/api/order",
    * operationId="Order",
    * tags={"Order"},
    * summary="Oder Add",
    * description="Order Add here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"client","details"},
    *               @OA\Property(property="client", type="text"),
    *               @OA\Property(property="details", type="text"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Order Added Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Order Added Successfully",
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
    public function store(Request $request): JsonResponse 
    {
        $validator = Validator::make($request->all(), [
            'client' => 'required',
            'details' => 'required',
        ]);

       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        $success['name'] =  $orderDetails['client'];
        $respons = $this->orderRepository->createOrder($orderDetails);

        if($respons){
            return $this->sendResponse($success, 'Client details added successfully.');
        }else{
            return $this->sendError('Error', ['error'=>'Something went wrong']);
        }
    
      

        // return response()->json(
        //     [
        //         'data' => $this->orderRepository->createOrder($orderDetails)
        //     ],
        //     Response::HTTP_CREATED
        // );
    }

    public function show(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');

        return response()->json([
            'data' => $this->orderRepository->getOrderById($orderId)
        ]);
    }

    public function update(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->orderRepository->updateOrder($orderId, $orderDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $this->orderRepository->deleteOrder($orderId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
