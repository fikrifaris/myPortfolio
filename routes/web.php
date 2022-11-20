<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todoController;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::view('/about', 'about');

Route::get('statistics', [ChartController::class, 'index']);

Route::get('portfolio', [todoController::class, 'index']);
Route::post('/addDate', [todoController::class, 'store']);
Route::post('/addTask/{id}', [todoController::class, 'storeTask']);
Route::put('/todos/{id}', [todoController::class, 'update']);
Route::put('/editTask/{id}', [todoController::class, 'updateTask']);
Route::put('/marked/{id}', [todoController::class, 'checkTask']);
Route::delete('/todos/{id}', [todoController::class, 'destroy']);
Route::delete('/taskDel/{id}', [todoController::class, 'destroyTask']);
