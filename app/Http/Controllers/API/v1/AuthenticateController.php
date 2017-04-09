<?php

namespace App\Http\Controllers\API\v1;

use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends \App\Http\Controllers\Controller {

    public function index() {
        $credentials = [
            'email' => 'ahmed.fathiie@gmail.com',
            'password' => 'password',
        ];

        $x = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::register($credentials);
        dd($x);
    }

    /**
     *  API Login, on success return JWT Auth token
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request) {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($credentials)) {
                return response()->json([
                            'error' => 1,
                            'message' => 'Wrong Credentials'
                                ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                        'error' => 1,
                        'message' => "couldn't create token"
                            ], 500);
        }

        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findUserByCredentials($credentials);
        $user->token = $token;
        $array = [
            'error' => 0,
            'user' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'token' => $user->token,
            ]
        ];

        // all good so return the token
        return response()->json($array);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);
        \JWTAuth::invalidate($request->input('token'));
    }

    public function go() {


        dd($user);
    }

    /**
     * Returns the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser() {
        try {
            if (!$user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * Refresh the token
     *
     * @return mixed
     */
    public function getToken() {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = \Tymon\JWTAuth\Facades\JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->errorInternal('Not able to refresh Token');
        }
        return $this->response->withArray(['token' => $refreshedToken]);
    }

}
