<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('livro')->group(function (){
    Route::get('/{id}', [LivroController::class, 'show'])->name('livro_show');
    Route::post('/all', [LivroController::class, 'all'])->name('livros');
    Route::post('/create', [LivroController::class, 'create'])->name('livro_update');
    Route::post('/update/{id}', [LivroController::class, 'update'])->name('livro_update');
    Route::post('/delete/{id}', [LivroController::class, 'delete'])->name('livro_delete');

    // Consulta autor
    Route::post('/consulta/autor', [LivroController::class, 'consulta_autor'])->name('consulta_autor');
});