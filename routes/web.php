<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
    return redirect()->route('pages.index');
});

Route::get('pages', [PageController::class, 'index'])->name('pages.index');
Route::post('pages', [PageController::class, 'store'])->name('pages.store');
Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
Route::get('pages/schema/{page}', [PageController::class, 'schemaEdit'])->name('pages.schema_edit');
Route::put('pages/schema/{page}', [PageController::class, 'schemaUpdate'])->name('pages.schema_update');
Route::get('pages/content/{page}', [PageController::class, 'contentEdit'])->name('pages.content_edit');
Route::put('pages/content/{page}', [PageController::class, 'contentUpdate'])->name('pages.content_update');
