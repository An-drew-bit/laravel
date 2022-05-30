<?php

use App\Http\Controllers\Api\DocumentController;
use Illuminate\Support\Facades\Route;

Route::controller(DocumentController::class)->group(function () {
    Route::post('/document', 'createDocument');
    Route::get('/document/{id}', 'getDocumentById');
    Route::patch('/document/{id}', 'editDocument');
    Route::post('/document/{id}/publish', 'updatePublishedDocument');
    Route::get('/document', 'documentGetAll');
});
