<?php
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('vendas', VendaController::class);
    Route::get('vendas/{id}/pdf', [VendaController::class, 'generatePDF'])->name('vendas.pdf');
});
