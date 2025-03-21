<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/checklist',[ChecklistController::class,'index']);//done
    Route::post('/checklist',[ChecklistController::class,'store']);//done
    Route::delete('/delete/{checklistId}',[ChecklistController::class,'delete']);//done

    Route::get('/checklist/{checkListId}/item',[ChecklistItemController::class,'index']);//done
    Route::post('/checklist/{checkListId}/item',[ChecklistItemController::class,'store']);//done
    Route::get('/checklist/{checkListId}/item/{checklistItemId}',[ChecklistItemController::class,'show']);//done
    Route::put('/checklist/{checkListId}/item/{checklistItemId}',[ChecklistItemController::class,'updateStatus']);//done
    Route::delete('/checklist/{checkListId}/item/{checklistItemId}',[ChecklistItemController::class,'delete']);//done
    Route::put('/checklist/{checkListId}/item/rename/{checklistItemId}',[ChecklistItemController::class,'update']);

});
