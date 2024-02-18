<?php
/**
 * Created by PhpStorm.
 * File: app.php
 * Project: lumen
 * User: hnher
 * DateTime: 2021-12-20 10:30:14
 */

use Laravel\Lumen\Routing\Router;
/**
 * @var Router $router
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'inside'], function (Router $router) {

    $router->get('/', 'ExampleController@index');

});
