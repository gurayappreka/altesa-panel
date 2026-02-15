<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StockController extends Controller
{
    public function alerts()
    {
        $products = Product::with('supplier')
            ->lowStock()
            ->orderBy('stock_quantity')
            ->paginate(15);

        return view('stock.alerts', compact('products'));
    }
}
