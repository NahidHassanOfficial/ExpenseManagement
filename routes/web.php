<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Dashboard/AddExpense')->name('addExpense');
Route::inertia('/summary', 'Dashboard/Summary')->name('summary');
Route::inertia('/expense-list', 'Dashboard/ExpenseList')->name('expenseList');
