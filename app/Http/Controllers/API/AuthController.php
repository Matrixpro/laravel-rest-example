<?php
   
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;

class AuthController extends BaseController
{

    /**
     * API Login
     * 
     * Login via API
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

    /**
     * API Register
     * 
     * Register new user via API
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
   
}