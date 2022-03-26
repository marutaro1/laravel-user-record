<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactoryUserController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveMemoController;
use App\Http\Controllers\DailyWorkController;
use App\Http\Controllers\StaffDailyWorkController;
use App\Http\Controllers\CompleteWorkCheckController;

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

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user_id}', [UserController::class, 'show']);

Route::get('/factoryusers', [FactoryuserController::class, 'index']);
Route::post('/factoryusers', [FactoryuserController::class, 'store']);
Route::get('/factoryusers/{factoryuser}', [FactoryuserController::class, 'show']);
Route::put('/factoryusers/{factoryuser}', [FactoryuserController::class, 'update']);

Route::get('/factoryusers/{factoryuser}/records', [RecordController::class, 'index']);
Route::post('/factoryusers/{factoryuser}/records', [RecordController::class, 'store']);
Route::get('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'show']);
Route::put('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'update']);
Route::delete('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'delete']);

Route::get('/archives', [ArchiveController::class, 'index']);
Route::post('/archives', [ArchiveController::class, 'store']);
Route::get('/archives/{archive}', [ArchiveController::class, 'show']);
Route::put('/archives/{archive}', [ArchiveController::class, 'update']);
Route::delete('/archives/{archive}', [ArchiveController::class, 'delete']);

Route::get('/memos', [ArchiveMemoController::class, 'index']);
Route::post('/memos', [ArchiveMemoController::class, 'store']);
Route::get('/memos/{memo}', [ArchiveMemoController::class, 'show']);
Route::delete('/memos/{memo}', [ArchiveMemoController::class, 'delete']);

Route::get('/daily_work', [DailyWorkController::class, 'index']);
Route::post('/daily_work', [DailyWorkController::class, 'store']);

Route::get('/staff_daily_work', [StaffDailyWorkController::class, 'index']);
Route::post('/staff_daily_work', [StaffDailyWorkController::class, 'store']);

Route::get('/complete_works', [CompleteWorkCheckController::class, 'index']);
Route::post('/complete_works', [CompleteWorkCheckController::class, 'store']);
Route::get('/complete_works/{complete_work_id}', [CompleteWorkCheckController::class, 'show']);
Route::post('/complete_works/{complete_work_id}', [CompleteWorkCheckController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
