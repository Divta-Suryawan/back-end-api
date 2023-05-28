<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;

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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('kategori', ['uses' => 'KategoriController@index']);
    $router->get('kategori/{id}', ['uses' => 'KategoriController@show']);
    $router->delete('kategori/{id}', ['uses' => 'KategoriController@destroy']);
    $router->post('kategori/{id}', ['uses' => 'KategoriController@update']);
    $router->post('kategori/', ['uses' => 'KategoriController@create']);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('pelanggan', ['uses' => 'PelangganController@index']);
    $router->get('pelanggan/{id}', ['uses' => 'PelangganController@show']);
    $router->delete('pelanggan/{id}', ['uses' => 'PelangganController@destroy']);
    $router->put('pelanggan/{id}', ['uses' => 'PelangganController@update']);
    $router->post('pelanggan/{id}', ['uses' => 'PelangganController@create']);
});

