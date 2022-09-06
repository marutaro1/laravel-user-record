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
use App\Http\Controllers\ManuelController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentRecordController;

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
Route::get('/users/name/{user_name}', [UserController::class, 'serch']);

Route::get('/factoryusers', [FactoryuserController::class, 'index']);
Route::post('/factoryusers', [FactoryuserController::class, 'store']);
Route::get('/factoryusers/{day}', [FactoryuserController::class, 'check']);
Route::get('/factoryusers/{factoryuser}', [FactoryuserController::class, 'show']);
Route::put('/factoryusers/{factoryuser}', [FactoryuserController::class, 'update']);
Route::get('/serch/{day}/{factoryuser_keyword}/{floor_keyword}/{care_level_keyword}', [FactoryuserController::class, 'serch']);

Route::get('/factoryusers/{factoryuser}/records/{day}/{day_end}', [RecordController::class, 'index']);
Route::post('/factoryusers/{factoryuser}/records', [RecordController::class, 'store']);
Route::get('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'show']);
Route::put('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'update']);
Route::get('/{factoryuser}/serch/{record_keyword}/{day}/{day_end}', [RecordController::class, 'serch']);
Route::delete('/factoryusers/factoryuser/records/{record}', [RecordController::class, 'delete']);

Route::get('/factoryusers/{factoryuser}/manuels', [ManuelController::class, 'index']);
Route::post('/factoryusers/{factoryuser}/manuels', [ManuelController::class, 'store']);
Route::get('/factoryusers/manuels/{manuel}', [ManuelController::class, 'show']);
Route::put('/factoryusers/manuels/{manuel}', [ManuelController::class, 'update']);
Route::get('/{factoryuser}/manuel_serch/{manuel_keyword}', [ManuelController::class, 'serch']);
Route::delete('/factoryusers/manuels/{manuel}', [ManuelController::class, 'delete']);

Route::get('/factoryusers/{factoryuser}/medical_histories', [MedicalHistoryController::class, 'index']);
Route::post('/factoryusers/{factoryuser}/medical_histories', [MedicalHistoryController::class, 'store']);
Route::get('/factoryusers/medical_histories/{medical_history}', [MedicalHistoryController::class, 'show']);
Route::put('/factoryusers/medical_histories/{medical_history}', [MedicalHistoryController::class, 'update']);
Route::get('/{factoryuser}/medical_history_serch/{medical_keywprd}/{history_keyword}', [MedicalHistoryController::class, 'serch']);
Route::delete('/factoryusers/medical_histories/{medical_history}', [MedicalHistoryController::class, 'delete']);

Route::get('/factoryusers/{factoryuser}/treatments', [TreatmentRecordController::class, 'index']);
Route::post('/factoryusers/{factoryuser}/treatments', [TreatmentRecordController::class, 'store']);
Route::get('/factoryusers/treatments/{treatment}', [TreatmentRecordController::class, 'show']);
Route::put('/factoryusers/treatments/{treatment}', [TreatmentRecordController::class, 'update']);
Route::get('/{factoryuser}/treatment_serch/{treatment_keyword}', [TreatmentRecordController::class, 'serch']);
Route::delete('/factoryusers/treatments/{treatment}', [TreatmentRecordController::class, 'delete']);

Route::get('/treatments', [TreatmentController::class, 'index']);
Route::post('/treatments', [TreatmentController::class, 'store']);
Route::get('/treatments/{treatment}', [TreatmentController::class, 'show']);
Route::put('/treatments/{treatment}', [TreatmentController::class, 'update']);
Route::delete('/treatments/{treatment}', [TreatmentController::class, 'delete']);

Route::get('/archives/{day}', [ArchiveController::class, 'index']);
Route::post('/archives/{day}', [ArchiveController::class, 'store']);
Route::get('/archives/{archive}', [ArchiveController::class, 'show']);
Route::put('/archives/{archive}', [ArchiveController::class, 'update']);
Route::post('/archives_copy/{day}', [ArchiveController::class, 'copy']);
Route::delete('/archives/{archive}', [ArchiveController::class, 'delete']);

Route::get('/memos/{day}/{user}', [ArchiveMemoController::class, 'index']);
Route::post('/memos/{day}/{user}', [ArchiveMemoController::class, 'store']);
Route::get('/memos/{day}/{user}/{factoryuser}/{memo}', [ArchiveMemoController::class, 'show']);
Route::delete('/memos/{memo}', [ArchiveMemoController::class, 'delete']);

Route::get('/daily_work/{day_of_week}/{department}', [DailyWorkController::class, 'index']);
Route::post('/daily_work/{day_of_week}/{department}', [DailyWorkController::class, 'store']);

Route::get('/staff_daily_work/{day}/{department}', [StaffDailyWorkController::class, 'index']);
Route::post('/staff_daily_work/{day}/{department}', [StaffDailyWorkController::class, 'store']);
Route::get('/staff_daily_work/{day}/{department}/{user_name}', [StaffDailyWorkController::class, 'show']);
// Route::post('/staff_daily_work/{day}/{department}/{user}', [StaffDailyWorkController::class, 'store']);

Route::get('/complete_works/{day}', [CompleteWorkCheckController::class, 'index']);
Route::post('/complete_works/{day}', [CompleteWorkCheckController::class, 'store']);
Route::get('/complete_works/{day}/{user_name}', [CompleteWorkCheckController::class, 'show']);
Route::post('/complete_works/{day}/{user_name}', [CompleteWorkCheckController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
