<?php

use App\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;

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


Route::redirect('/', '/index');

Route::get('/index', [ParkingController::class, 'index'])->name('index');
Route::get('/delete/{id}', [ParkingController::class, 'delete'])->name('delete');
Route::get('/create', [ParkingController::class, 'create'])->name('create');
Route::post('/add', [ParkingController::class, 'add'])->name('add');
Route::get('/edit/{id}', [ParkingController::class, 'edit'])->name('edit');
Route::post('/update', [ParkingController::class, 'update'])->name('update');
Route::post('/addcar', [ParkingController::class, 'addCar'])->name('addcar');
Route::get('/location/{clientId?}/{carId?}', [ParkingController::class, 'location'])->name('location');
Route::get('/changeLocation/{carId}/{is_set}', [ParkingController::class, 'changeLocation'])->name('changeLocation');

