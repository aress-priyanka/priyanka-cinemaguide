<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * success response method.
    *
    * @return \Illuminate\Http\Response
    */
  public function sendResponse($result, $message)
  {
    $response = [
      'success' => true,
      'data'    => $result,
      'message' => $message
    ];

    return response()->json($response, 200);
  }


  /**
  * return error response.
  *
  * @return \Illuminate\Http\Response
  */
  public function sendError($error, $errorMessages = [], $code = 404)
  {
    $response = [
      'success' => false,
      'message' => $error
    ];

    if(!empty($errorMessages)){
      $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
  }

  /**
   * Register.
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password'
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;

    return $this->sendResponse($success, 'User register successfully.');
  }

  /**
   * Login.
   *
   * @return \Illuminate\Http\Response
   */
  public function login (Request $request) {
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')-> accessToken;
      $success['name'] =  $user->name;
      return $this->sendResponse($success, 'User login successfully.');
    }
    else {
      return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    }
  }
}
