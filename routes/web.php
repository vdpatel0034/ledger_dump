<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedgerController;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php


Route::get('/ledgers', [LedgerController::class, 'index'])->name('ledger.index');
