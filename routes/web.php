<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, "index"] ); // todos os registros
Route::get('/teste', [EventController::class, "teste"] ); // todos os registros
Route::get('/produtos', [EventController::class, "products"] );
Route::get('/contatos', [EventController::class, "contacts"] );
Route::get('/events/create', [EventController::class, "create"] )->middleware("auth"); // Formulário de inserção de dados - middleaware de autenticação
Route::get('/events/{id}', [EventController::class, "show"] ); // Mostra um registro específico
Route::get('/dashboard', [EventController::class, "dashboard"])->middleware("auth"); // insere eventos ao DB
Route::get('/events/edit/{id}', [EventController::class, "edit"])->middleware("auth"); // insere eventos ao DB
Route::put('/events/update/{id}', [EventController::class, "update"])->middleware("auth"); // insere eventos ao DB
Route::post('/events', [EventController::class, "store"] ); // insere eventos ao DB
Route::delete('/events/{id}', [EventController::class, "destroy"])->middleware("auth"); // insere eventos ao DB
Route::delete('/events/leave/{id}', [EventController::class, "leaveEvent"])->middleware("auth"); // insere eventos ao DB
Route::post('/events/join/{id}', [EventController::class, "joinEvent"])->middleware("auth"); // insere eventos ao DB

/* Route::get('/teste', function () {

    $nome = "Gilberto";
    $arr = [10,20,30];

    return view('teste', ["nome" => $nome, "arr" => $arr]);
}); */

/* Route::get('/produtos/{id}', function ($id) { PASSANDO PARÂMETRO NA URL

    return view('product', ["id" => $id]);
}); */

/* Route::get('/produtos', function () {

    $busca = request("search");
    return view('product', ["search" => $busca]); // QUERYPARÃMETER
});

Route::get('/produtos_teste/{id?}', function ($id = null) { // PARÃMETRO OPCIONAL

    return view('product', ["id" => $id]);
}); */

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
