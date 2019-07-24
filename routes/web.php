<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);

/*
$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
*/
$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->post('/user/create', 'UserController@store');
	$router->get('/user/edit/{id}', 'UserController@edit');
	$router->post('/user/update/{id}', 'UserController@update');
	$router->delete('/user/delete/{id}', 'UserController@delete');
	$router->get('users', 'UserController@index');
    }
);
