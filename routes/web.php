<?php

use App\Http\Controllers\Contacts\ContactsController;
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

Route::get('/', function () {
    return redirect()->route('contacts.index');
});

//Route::middleware('auth')->group(function () {
/** Contacts routes */
Route::prefix('contacts')->controller(ContactsController::class)->group(function () {
    Route::get('', 'index')->name('contacts.index');
    Route::get('contacts/edit/{contact}', 'edit')->name('contacts.edit');
    Route::get('contacts/create', 'create')->name('contacts.create');
    Route::post('contacts/store', 'store')->name('contacts.store');
    Route::put('contacts/update/{contact}', 'update')->name('contacts.update');
    Route::delete('contacts/delete/{contact}', 'destroy')->name('contacts.delete');
});
//});
