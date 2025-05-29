<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;

class PageController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        

        return view('dashboard.index', compact(
            'totalCustomers',
            'totalProducts',
            'totalTransactions',
        ));
    }
}