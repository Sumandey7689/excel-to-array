<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;


Route::get('/upload-excel', [ExcelController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload-excel', [ExcelController::class, 'uploadExcel'])->name('upload.excel');
