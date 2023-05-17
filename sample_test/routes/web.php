<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\TranslateController;
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
Route::prefix("translates")->middleware(["auth"])
    ->controller(TranslateController::class)
    ->name("translate.")
    ->group(function () {
        Route::get("/", "index")->name("index");
    });
Route::resource("contacts", ContactFormController::class)->middleware(["auth"])->except("update","destroy");
Route::prefix("contacts")->middleware(["auth"])
    ->controller(ContactFormController::class)
    ->name("contacts.")
    ->group(function () {
        Route::post("/{contact}", "update")->name("update");
        Route::post("/{contact}/destroy", "destroy")->name("destroy");
    });
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
