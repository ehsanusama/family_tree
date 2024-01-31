<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\FamilyTreeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('people')->group(function () {
    Route::get('/', [PeopleController::class, 'index']);
    Route::post('/', [PeopleController::class, 'store']);
    Route::get('/{People}', [PeopleController::class, 'show']);
    Route::put('/{id}', [PeopleController::class, 'update']);
    Route::delete('/{People}', [PeopleController::class, 'destroy']);
});


Route::prefix('connections')->group(function () {
    Route::get('/', [ConnectionController::class, 'index']);
    Route::post('/', [ConnectionController::class, 'store']);
    Route::get('/{connection}', [ConnectionController::class, 'show']);
    Route::put('/{connection}', [ConnectionController::class, 'update']);
    Route::delete('/{connection}', [ConnectionController::class, 'destroy']);
});


Route::get('/people/{personId}/family-tree', [FamilyTreeController::class, 'familyTree']);


    