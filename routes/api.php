<?php declare(strict_types=1);

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/transaction', [TransactionController::class, 'index']);
