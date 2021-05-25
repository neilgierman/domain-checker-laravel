<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Domain;
use App\Jobs\DomainCreateJob;
use App\Jobs\DomainUpdateJob;
use App\Http\Resources\DomainResource;
use App\Http\Resources\DomainResourceCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('domains', function() {
    return new DomainResourceCollection(Domain::all());
});

Route::get('domains/{id}', function($id) {
    return new DomainResource(Domain::findOrFail($id));
});

Route::post('domains', function(Request $request) {
    DomainCreateJob::dispatch($request->all());
    return response()->json([
        "message" => "Create queued"
    ], 202);
});

Route::put('domains/{id}', function(Request $request, $id) {
    DomainUpdateJob::dispatch($request->all(), $id);
    return response()->json([
        "message" => "Update queued"
    ], 202);
});

Route::delete('domains/{id}', function($id) {
    Domain::find($id)->delete();
    return 204;
});
