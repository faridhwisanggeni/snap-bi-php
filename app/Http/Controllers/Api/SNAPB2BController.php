<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTFactory;


class SNAPB2BController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {


        /**
         * $binary_signature yang ada pada SignatureController akan di cari pada database berdasarkan parameter header X-SIGNATURE
         */

        $email = 'faridh.wisanggeni@astrapay.com';
        $password = '12345678';
        $request->request->add(['email' => $email]);
        $request->request->add(['password' => $password]);

       //set validation
       $validator = Validator::make($request->all(), [
        'grantType'     => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

    //     // get credentials from request
        $credentials = $request->only('email', 'password');

    //     //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'responseCode' => "4017300",
                'responseMessage' => "Successful",
                'accessToken'   => $tokennya,
                'tokenType' => "Bearer",
                'expiresIn' => "900",
                'additionalInfo' => "{}",
            ], 401);
        }


        $tokennya = JWTAuth::attempt($credentials);


        // if auth success
        return response()->json([
            'responseCode' => "2007300",
            'responseMessage' => "Successful",
            'accessToken'   => $tokennya,
            'tokenType' => "Bearer",
            'expiresIn' => "900",
            'additionalInfo' => "{}",
            //'user'    => auth()->guard('api')->user(),
        ], 200);







    }
}
