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

Route::get('/dashboard', 'AgendaController@dashboard');
Route::get('/dados-grafico-questao/{idQuestao}', 'AgendaController@dadosGraficoQuestao');

Route::get('/agenda/index', 'AgendaController@index');

Route::get('/agenda/ppc', 'AgendaController@ppc');
Route::get('/agenda/ppc-intensivo-pre', 'AgendaController@ppcIntensivoPre');
Route::get('/agenda/executive', 'AgendaController@executive');
Route::get('/agenda/xtreme', 'AgendaController@xtreme');

Route::get('/agenda/{agenda}', 'AgendaController@agenda');
