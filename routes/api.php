<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


 Route::get('', 'App\Http\Controllers\LojaController@index');
 Route::prefix('criar')->group(function(){
    Route::post('/roupa','App\Http\Controllers\LojaController@criar_roupa');
    Route::post('/estampa','App\Http\Controllers\LojaController@criar_estampa');
    Route::post('/produto','App\Http\Controllers\LojaController@criar_produto');
 });
 
 Route::prefix('encontrar')->group(function(){
    Route::get('/roupa/{id}','App\Http\Controllers\LojaController@encontrar_roupa' );
    Route::get('/estampa/{id}','App\Http\Controllers\LojaController@encontrar_estampa' );
    Route::get('/produto/{id}','App\Http\Controllers\LojaController@encontrar_produto' );
 });

 Route::prefix('atualizar')->group(function(){
    Route::put('/roupa/{id}','App\Http\Controllers\LojaController@atualizar_roupa' );
    Route::put('/estampa/{id}','App\Http\Controllers\LojaController@atualizar_estampa' );
    Route::put('/produto/{id}','App\Http\Controllers\LojaController@atualizar_produto' );
});

 Route::prefix('excluir')->group(function(){
    Route::delete('/roupa/{id}','App\Http\Controllers\LojaController@excluir_roupa');
    Route::delete('/estampa/{id}','App\Http\Controllers\LojaController@excluir_estampa');
    Route::delete('/produto/{id}','App\Http\Controllers\LojaController@excluir_produto');
});