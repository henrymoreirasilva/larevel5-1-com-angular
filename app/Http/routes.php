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


Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {
    Route::resource('client', 'ClientController', ['except', ['edit', 'create']]);

   // Route::group comentado para fazer a verificação de autorização em ProjectController.
   // Route::group(['middleware' => 'CheckProjectOwner'], function() {
        Route::resource('project', 'ProjectController', ['except', ['edit', 'create']]);
        
        Route::resource('project/{project}/note', 'ProjectNoteController', ['except', ['edit', 'create']]);
        
        Route::post('project/{project}/file', 'ProjectFileController@store');
   // });
    
});
