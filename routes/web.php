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

$router->get('/weather/setwebhook', 'BotController@setWebHook');

/*$router->post(\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken(), function () {
    \Telegram\Bot\Laravel\Facades\Telegram::commandsHelper(true);
});*/

$router->post(\Telegram\Bot\Laravel\Facades\Telegram::getAccessToken(), function () {
    \Telegram\Bot\Laravel\Facades\Telegram::commandsHandler(true);
});

$router->get('/weather/getme', 'BotController@getMe');
