<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quote;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => Customer::active()->count(),
            'quotes' => Quote::whereIn('status', ['draft', 'sent'])->count(),
            'purchases' => Purchase::where('status', 'pending')->count(),
            'low_stock' => Product::lowStock()->count(),
            'active_projects' => Project::active()->count(),
            'my_tasks' => Task::where('assigned_to', auth()->id())->whereIn('status', ['todo', 'in_progress'])->count(),
        ];

        $recent_quotes = Quote::with(['customer', 'user'])
            ->latest()
            ->take(5)
            ->get();

        $my_tasks = Task::with(['project'])
            ->where('assigned_to', auth()->id())
            ->whereIn('status', ['todo', 'in_progress'])
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $low_stock_products = Product::with(['supplier'])
            ->lowStock()
            ->take(10)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_quotes', 'my_tasks', 'low_stock_products'));
    }
}
