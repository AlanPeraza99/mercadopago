<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
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
    return view('welcome');
});

Route::get('/testing', [TestingController::class, 'show']);
Route::get('/mirar_cliente', [TestingController::class, 'showClient']);
Route::post('/mercado', [TestingController::class, 'create']);
Route::get('/costumer', [TestingController::class, 'createClient']);
Route::get('/cards', [TestingController::class, 'showCardsByCostumer']);
Route::post('/process_payment', [TestingController::class, 'cardProccess']);

Route::get('/', function () {
    return view('form');
});
Route::get('/form', function () {
    return view('form');
});