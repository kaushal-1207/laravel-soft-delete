<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Dd;

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

// Soft Delete Records
Route::get('/softdelete/{id}', function ($id) {
    $data = User::where('id', $id)->delete();
    $data ? dd('Deleted') : dd('Error');
});

// Get Records (Exclude Soft Delete Records)
Route::get('/getrecords', function () {
    $data = User::pluck('id', 'name', 'email')->toArray();
    dd($data);
});

// Get Records (Include Soft Delete Records)
Route::get('/getallrecords', function () {
    $data = User::withTrashed()->pluck('id', 'name', 'email')->toArray();
    dd($data);
});