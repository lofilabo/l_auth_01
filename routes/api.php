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


Route::post('/fbwebhook', 'FBWebhookController@postindex');
Route::get('/fbwebhook', 'FBWebhookController@getindex');
Route::post('/fbwebhook/', 'FBWebhookController@postindex');
Route::get('/fbwebhook/', 'FBWebhookController@getindex');

Route::middleware('auth:api')->middleware('cors')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', array('middleware' => 'auth:api', 'middleware' => 'cors',  'uses' => 'TestController@index'));

//CORS example
// Route::get('example', array('middleware' => 'cors', 'uses' => 'ExampleController@dummy'));
