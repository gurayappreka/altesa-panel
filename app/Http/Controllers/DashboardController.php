<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quote;
use App\Models\Project;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => Customer::count(),
            'quotes' => Quote::count(),
            'projects' => Project::where('status', 'active')->count(),
            'products' => Product::count(),
            'purchases' => Purchase::where('status', 'pending')->count(),
            'low_stock' => Product::whereColumn('stock_quantity', '<=', 'min_stock_level')->where('min_stock_level', '>', 0)->count(),
        ];

        $recentQuotes = Quote::with('customer')->latest()->take(5)->get();
        $recentProjects = Project::with('customer')->latest()->take(5)->get();
        $myTasks = Task::where('assigned_to', auth()->id())->where('status', '!=', 'done')->take(5)->get();

        return view('dashboard.index', compact('stats', 'recentQuotes', 'recentProjects', 'myTasks'));
    }
}
