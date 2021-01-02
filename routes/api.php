<?php

use App\Http\Controllers\api\BallotController;
use App\Http\Controllers\api\CandidateController;
use App\Http\Controllers\api\ElectionController;
use App\Http\Controllers\api\InviteController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\VoterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware('auth:sanctum')->post('/elections', [ElectionController::class, 'store']);
//Route::middleware('auth:sanctum')->get('/elections', [ElectionController::class,'index']);
Route::middleware(['auth:sanctum', 'same'])->put('/elections/{election}', [ElectionController::class,'update']);

Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/invitations', [InviteController::class, 'store']);

Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/roles', [RoleController::class, 'store']);
Route::middleware(['auth:sanctum', 'same'])->put('/elections/{election}/roles/{role:id}', [RoleController::class, 'update']);

Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/roles/{role:id}/candidates', [CandidateController::class, 'store']);
Route::middleware(['auth:sanctum', 'same'])->put('/elections/{election}/roles/{role:id}/candidates/{candidate:id}', [CandidateController::class, 'update']);

Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/voters', [VoterController::class, 'store']);
Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/voters/factory', [VoterController::class, 'storeFactory']);

Route::middleware(['auth:sanctum', 'same'])->post('/elections/{election}/roles/{role:id}/ballots', [BallotController::class, 'store']);

Route::get('/elections/{election}/turnout/{token}', [ElectionController::class, 'turnout']);

Route::middleware(['auth:sanctum', 'same'])->get('/elections/{election}/roles/{role:id}/results', [ResultController::class, 'apiGenerate']);
Route::middleware(['auth:sanctum', 'same'])->get('/elections/{election}/roles/{role:id}/results/calculate/{method}', [ResultController::class, 'apiCalculate']);
