<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function revenue(Request $request)
    {
        
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $query = OrderModel::where('status_payment', 'paid')
                            ->whereMonth('created_at', $month)
                            ->whereYear('created_at', $year);

        $totalRevenue = $query->sum('total_price');
        $orders = $query->latest()->get();

        return view('admin.reports', compact('totalRevenue', 'orders', 'month', 'year'));
    }
}
