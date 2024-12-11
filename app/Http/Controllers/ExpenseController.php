<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExpenseController extends Controller
{
    //prodived exchange rates
    private $exchangeRates = [
        'USD' => 1,
        'EUR' => 0.91,
        'BDT' => 109.5,
        'JPY' => 140,
    ];

    private function roundByCurrency($currency, $amount)
    {
        //non decimal currency list collected from internet
        $nonDecimalCurrency = [
            "JPY", // Japanese Yen
            "KRW", // South Korean Won
            "IDR", // Indonesian Rupiah
            "VND", // Vietnamese Dong
            "ISK", // Icelandic Krona
            "IRR", // Iranian Rial
        ];

        //check if currency exist in the list and return rounded value
        if (in_array($currency, $nonDecimalCurrency)) {
            return round($amount);
        } else {
            return round($amount, 2);
        }

    }

    public function createExpense()
    {
        //validate user input
        try {
            request()->validate([
                'description' => 'required|string',
                'amount' => 'required|decimal:0,2',
                'currency' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'validation failed', 'data' => $e->errors()], 422);
        }

        // Check if the currency is supported
        if (!array_key_exists(request()->currency, $this->exchangeRates)) {
            return response()->json(['message' => 'validation failed', 'data' => ['currency' => 'Unsupported Currency']], 422);
        }

        //check if it non decimal currency and return result
        $resultAmount = $this->roundByCurrency(request()->currency, request()->amount);

        //create expense
        Expense::create([
            'description' => request()->description,
            'amount' => $resultAmount,
            'currency' => request()->currency,
        ]);

        return response()->json([
            'message' => 'Expense created successfully',
        ]);

    }

    public function allExpenseList()
    {
        //get expense in desc order to have latest on top
        $expenseData = Expense::orderByDesc('id')->get();
        return response()->json(['expenseData' => $expenseData]);
    }

    public function expenseSummary()
    {
        //get the query params and check if the parameter currency exist
        $baseCurrency = request()->baseCurrency;
        if (!array_key_exists($baseCurrency, $this->exchangeRates)) {
            return response()->json([
                'error' => 'Unsupported base currency.',
            ], 400);
        }

        // fetch all expenses
        $expenses = Expense::all();

        $totalInBaseCurrency = 0;
        $currencyWiseExpense = [];

        // calculate totals for each currency and the base currency
        foreach ($expenses as $expense) {

            $currency = $expense->currency;
            $amount = $expense->amount;

            if (!isset($currencyWiseExpense[$currency])) {
                $currencyWiseExpense[$currency] = 0;
            }
            $currencyWiseExpense[$currency] += $amount;

            //convert each currency amount in baseCurrency
            $rateToBase = $this->exchangeRates[$baseCurrency] / $this->exchangeRates[$currency];
            $convertedAmount = $amount * $rateToBase;
            $totalInBaseCurrency += $convertedAmount;

        }

        //check if basecurrency is non decimal currency and return result
        $totalInBaseCurrency = round($this->roundByCurrency($baseCurrency, $totalInBaseCurrency), 2);

        return response()->json([
            'totalExpense' => [$baseCurrency => $totalInBaseCurrency],
            'currencyWiseExpense' => $currencyWiseExpense,
        ]);
    }

}
