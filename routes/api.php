<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

Route::get('/', function(){
    return response()->json([
        'Success' => true
    ]);
});

Route::get('/livros',[LivroController::class,'index']);
Route::get('/livros/{id}',[LivroController::class,'show']);
Route::post('/livros',[LivroController::class,'store']);
Route::delete('/livros/{id}',[LivroController::class,'destroy']);
Route::put('/livros/{id}',[LivroController::class,'update']);