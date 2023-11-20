<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class AuthController extends Controller
{
    public function index(){
        $users = User::where('role', 'user')->get();
        return response()->json([
            'data' => $users
        ]);
    }
    public function register(Request $request)
    {
        // return  response()->json([
        //     'data' => $request->all(),
            
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'userName' => 'nullable',
            'phone' => 'nullable',
        ]);

        if($validator->fails()){

            return response()->json([
                'message' => 'Validation Error',
                'error' => $validator->errors()
            ]);
                   
        }else{
            $user = User::create([
                
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_name' => $request->userName,
                'phone' => $request->phone,

            ]);
            if($user){
                return response()->json([
                    'token' => $user->createToken('MyApp')->accessToken,
                    'data' => $user,
                    'message' => 'Registration Completed successfully'
                ]);
            }else{
                return response()->json([
                    'error' => 'Something went wrong'
                ]);
            }
            
        }

   
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;
   
        // return response()->json([
        //     'token' => $user->createToken('MyApp')->accessToken,
        //     'data' => $user,
        //     'message' => 'registration successfull'
        // ]);
    }

    public function login(Request $request)
    {
    
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            if($user->role == 'user'){
                return response()->json([
                    'token' => $user->createToken('MyApp')->accessToken,
                    'data' => $user,
                ]);
            }else{
                return response()->json([
                    'error' => 'Unauthorised'
                ]);
            } 

        }else{ 
            return response()->json([
                'error' => 'Unauthorised'
            ]);
        }
    }
}
