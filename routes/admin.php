<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;

Route::group(
    [
        'middleware'    => ['auth']
    ], function(){

        //home
        Route::get('/', [HomeController::class,'index'])->name('index');

        //albums
        Route::resource('albums', AlbumController::class)->name('*','albums');
        Route::post('albums/{album}/upload_image', [AlbumController::class, 'upload_image'])->name('albums.upload_image');
        Route::delete('albums/{album}/image/{id}', [AlbumController::class, 'destroy_image'])->name('albums.image.destroy');
        Route::post('albums/{album}/move/images', [AlbumController::class, 'move_images_to_another_album'])->name('albums.images.move');

});


// Auth admins
Route::group(['prefix' => 'admin'] , function(){
    // Authentication Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

});
