<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $revenueMonth = OrderModel::where('status_payment', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        $totalOrders = OrderModel::whereMonth('created_at', now()->month)->count();

        $toProcessCount = OrderModel::where('status_payment', 'pending')
            ->orWhere('status_shipping', 'pending')
            ->count();

        $newCustomers = User::where('role', 'customer')
            ->whereMonth('created_at', now()->month)
            ->count();

        $recentTransactions = OrderModel::with('user')->latest()->take(5)->get();

        $processQueue = OrderModel::with(['user', 'items'])
            ->where('status_payment', 'pending')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'revenueMonth',
            'totalOrders',
            'toProcessCount',
            'newCustomers',
            'recentTransactions',
            'processQueue'
        ));
    }
}
