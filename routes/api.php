<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComandesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Check token permissions for Group 1
    Route::get('/comandes', function (Request $request) {
        if ($request->user()->tokenCan('read') && $request->user()->tokenCan('create')) {
            return app(ComandesController::class)->index($request);
        }
        abort(403, 'Unauthorized');
    });

    Route::get('/comandes/pendents', function (Request $request) {
        if ($request->user()->tokenCan('read') && $request->user()->tokenCan('create')) {
            return app(ComandesController::class)->getPendentComandes($request);
        }
        abort(403, 'Unauthorized');
    });

    Route::get('/comandes/{idcomanda}', function (Request $request, $idcomanda) {
        if ($request->user()->tokenCan('read') && $request->user()->tokenCan('create')) {
            return app(ComandesController::class)->show($request, $idcomanda);
        }
        abort(403, 'Unauthorized');
    });

    Route::put('/comandes/{idcomanda}', function (Request $request, $idcomanda) {
        if ($request->user()->tokenCan('read') && $request->user()->tokenCan('create')) {
            return app(ComandesController::class)->update($request, $idcomanda);
        }
        abort(403, 'Unauthorized');
    });

    Route::delete('/comandes/{idcomanda}', function (Request $request, $idcomanda) {
        if ($request->user()->tokenCan('read') && $request->user()->tokenCan('create')) {
            return app(ComandesController::class)->destroy($request, $idcomanda);
        }
        abort(403, 'Unauthorized');
    });

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Check token permissions for Group 2
    Route::post('/comandes/create', function (Request $request) {
        if ($request->user()->tokenCan('create') && $request->user()->tokenCan('read') && $request->user()->tokenCan('update') && $request->user()->tokenCan('delete')) {
            return app(ComandesController::class)->store($request);
        }
        abort(403, 'Unauthorized');
    });

    Route::get('/comandes/{mail}', function (Request $request, $mail) {
        if ($request->user()->tokenCan('create') && $request->user()->tokenCan('read') && $request->user()->tokenCan('update') && $request->user()->tokenCan('delete')) {
            return app(ComandesController::class)->getClientComandes($request, $mail);
        }
        abort(403, 'Unauthorized');
    });

});
