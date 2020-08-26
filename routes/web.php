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

$router->get('/users', 'UserController@list');
$router->get('/users/{hash}', 'UserController@getByHash');

$router->get('/pomodoros', 'PomodoroController@list');
$router->get('/pomodoros/{hash}/months/last', 'PomodoroController@lastMonth');
$router->post('/pomodoros', 'PomodoroController@create');

$router->post('/register', 'UserController@register');

$router->post('/tags/add', 'TagController@addTag');
$router->post('/tags', 'TagController@create');
$router->delete('/tags', 'TagController@delete');

/** @TODOs */
//  GET /users/{user_hash}
//  GET /stats/{user_hash}
//  GET /tags
//  GET /tags/{name}
//  POST /pomodoros
//  GET /pomodoros
//  POST /login
//  POST /restore

/**
 * El endpoint register deberia ver si existe el mail y si existe devolver el link
 * Si no existe debe crear un user y un hash
 */

// https://es.stackoverflow.com/questions/304171/error-121-duplicate-key-on-write-or-update-mysql
