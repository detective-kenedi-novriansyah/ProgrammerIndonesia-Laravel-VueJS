<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('public/{filename}', function ($filename)
{
    $exists = Storage::disk('public')->exists($filename);
   
    if($exists) {
       
       //get content of image
       $content = Storage::get('public/'.$filename);
       
       //get mime type of image
       $mime = Storage::mimeType('public/'.$filename);
       //prepare response with image content and response code
       $response = Response::make($content, 200);
       //set header 
       $response->header("Content-Type", $mime);
       // return response
       return $response;
    } else {
       abort(404);
    }
});