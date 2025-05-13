<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictController;
use App\Services\NaiveBayesService;
use App\Http\Controllers\ProductController;

Route::get('/', [PredictController::class, 'form'])->name('predict.form');
Route::post('/predict', [PredictController::class, 'predict'])->name('predict');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');



Route::get('/train', function () {
    $service = new NaiveBayesService();
    $service->trainModel();
    return 'Model berhasil dilatih dan disimpan.';
});
