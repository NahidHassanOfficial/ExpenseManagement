<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::post('/expenses', [ExpenseController::class, 'createExpense'])->name('expense.create');
Route::get('/expenses', [ExpenseController::class, 'allExpenseList'])->name('expense.list');
Route::get('/summary/{baseCurrency}', [ExpenseController::class, 'expenseSummary'])->name('expense.summary');
