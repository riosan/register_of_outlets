<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/',['uses' => 'BookController@index','as'=>'home']);
//Route::get('message/{id}/edit',['uses' => 'BookController@edit','as' => 'message.edit'])->where(['id'=>'[0-9]+']);

//Route:get('page',)

/*Route::match(['get', 'post'], '/', function () {
    return 'Hello World';
});*/


/*Route::get('/',['uses' => 'RegistryController@registry','as' => 'home']);
Route::get('sendpost','RegistryController@getPost')->name('sendpost');*/



Route::controller('statistics','RegistryController');
Route::controller('/','AdminController');