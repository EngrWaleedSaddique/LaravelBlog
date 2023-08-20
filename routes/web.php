<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes  for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware'=>['web']],function(){

    //CustomAuthController Routes

    Route::get('login',[CustomAuthController::class,'login'])->name('login')->middleware('alreadyLoggedIn');
    Route::get('registration',[CustomAuthController::class,'registration'])->middleware('alreadyLoggedIn');
    Route::post('register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
    Route::post('login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
    Route::get('logout',[CustomAuthController::class,'logout'])->name('logout');
    Route::get('password/forgot',[CustomAuthController::class,'showForgetForm'])->name('forgot.password.form');
    Route::post('password/forgot',[CustomAuthController::class,'sendResetLink'])->name('forgot.password.link');
    Route::get('password/reset/{token}',[CustomAuthController::class,'showResetForm'])->name('reset.password.form');
    Route::post('password/reset',[CustomAuthController::class,'resetPassword'])->name('reset.password');

    
    //end of Custom Auth Routes Controller

    // Categories routes starts from here
    //in below route we used a except for create because in controller we romove the
    // code of create function it is not required. So its important to mention this one 
    // in laravel not to generate a route for create function of category controller.

    Route::resource('categories', CategoryController::class,['except'=>['create']])->middleware('isLoggedIn');
    //Categiries routes ends here

    //Tags routes start from here
    Route::resource('tags',TagController::class,['except'=>'create'])->middleware('isLoggedIn');
    //tags route ends here

    //Comments Routes are here
    Route::post('comments/{post_id}',[CommentController::class,'store'])->name('comment.store');
    //comments routes ends here

    Route::get('blog/{slug}',[BlogController::class,'getSingle'])->name('blog.single')->where('slug','[\w\d\-\_]+');
    Route::get('blog',[BlogController::class,'getIndex'])->name('blog.index');
    Route::get('/',[PagesController::class,'getIndex']);
    Route::get('about',[PagesController::class,'getAbout']);
    Route::get('contact', [PagesController::class, 'getContact']);
    Route::post('contact',[PagesController::class, 'postContact']);
    Route::resource('posts', PostController::class)->middleware('isLoggedIn');

});

