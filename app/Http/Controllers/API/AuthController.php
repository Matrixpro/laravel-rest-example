<?php
   
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;

/**
 * @group Auth
 * 
 * Login or register for a new account to get your auth token
 */
class AuthController extends BaseController
{
    /**
     * @unauthenticated API Register
     *
     * @bodyParam name string required Your name. Example: Jack Black
     * @bodyParam email string required Your email. Example: jack@example.com
     * @bodyParam password string required Your password. Example: password
     * @bodyParam confirm_password string required Confirm your password. Example: password
     * 
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <JSON>                    ( API Bearer Token + Name )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User registered.');
    }
    
    
    /**
     * API Login
     * 
     * @bodyParam name string required Your name. Example: Jack Black
     * @bodyParam email string required Your email. Example: jack@example.com
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <JSON>                    ( API Bearer Token + Name )
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->password])) { 
            $auth = Auth::user(); 
            
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
            $success['name'] =  $auth->name;
   
            return $this->handleResponse($success, 'User logged in.');
        }
        
        return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
    }
   
}