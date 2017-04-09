<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/test', 'App\Http\Controllers\API\v1\AuthenticateController@index');
    $api->post('/authenticate', 'App\Http\Controllers\API\v1\AuthenticateController@authenticate');
    $api->post('/logout', 'App\Http\Controllers\API\v1\AuthenticateController@logout');
    $api->post('/go', 'App\Http\Controllers\API\v1\AuthenticateController@go');
    $api->get('/token', 'App\Http\Controllers\API\v1\AuthenticateController@getToken');

});

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
    $api->post('/go', 'App\Http\Controllers\API\v1\AuthenticateController@go');
});

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');;*/
