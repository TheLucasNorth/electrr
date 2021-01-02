<?php

use App\Http\Controllers\Frontend\ElectionApiTokenController;
use App\Http\Controllers\Frontend\CandidateController;
use App\Http\Controllers\Frontend\ElectionController;
use App\Http\Controllers\Frontend\NominationController;
use App\Http\Controllers\Frontend\RoleController;
use App\Http\Controllers\Frontend\VoterController;
use App\Http\Controllers\ResultController;
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

Route::view('/', 'welcome');

Route::view('/dashboard', 'dashboard')->middleware(['auth:web', 'verified'])->name('dashboard');

Route::view('/dashboard/elections', 'dashboard.create.election')->middleware(['auth:web', 'verified'])->name('election.create');

Route::get('/dashboard/elections/{election}', [ElectionController::class, 'edit'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('election.edit');

Route::get('/dashboard/elections/{election}/api', [ElectionApiTokenController::class, 'index'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('election.api');

Route::get('/dashboard/elections/{election}/voters', [VoterController::class, 'index'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('voters');

Route::get('/dashboard/elections/{election}/voters/email', [VoterController::class, 'indexEmail'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('emailVoters');

Route::get('/dashboard/elections/{election}/roles', [RoleController::class, 'create'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('role.create');

Route::get('/dashboard/elections/{election}/roles/{role:id}', [RoleController::class, 'edit'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('role.edit');

Route::get('/dashboard/elections/{election}/roles/{role:id}/candidates', [CandidateController::class, 'create'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('candidate.create');

Route::get('/dashboard/elections/{election}/roles/{role}/candidates/{candidate}', [CandidateController::class, 'edit'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('candidate.edit');

Route::get('/dashboard/elections/{election}/roles/{role:id}/results', [ResultController::class, 'generate'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('results.raw');

Route::get('/dashboard/elections/{election}/roles/{role:id}/results/download', [ResultController::class, 'download'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('results.download');

Route::get('/dashboard/elections/{election}/roles/{role:id}/results/calculate/{method}', [ResultController::class, 'display'])->middleware(['auth:web', 'verified', 'managed', 'exists'])->name('results.calculate');

Route::view('/elections/{election}/login', 'voting.login')->middleware('exists');

Route::post('/elections/{election}/login', [VoterController::class, 'login'])->middleware('exists')->name('frontend.login');

Route::get('/elections/{election}', [ElectionController::class, 'show'])->middleware(['voter', 'exists'])->name('frontend.home');

Route::get('/elections/{election}/roles/{role:id}', [RoleController::class, 'show'])->middleware(['voter', 'exists'])->name('frontend.vote');

Route::get('/elections/{election}/nominations', [NominationController::class, 'index'])->middleware(['exists'])->name('frontend.nominations');

Route::get('/elections/{election}/nominations/{role}', [NominationController::class, 'create'])->middleware(['exists'])->name('frontend.nominate');

Route::get('/elections/{election}/login/{username}/{password}', [VoterController::class, 'linkLogin'])->middleware('exists')->name('frontend.linkLogin');
