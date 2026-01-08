<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel as Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status_payment' => $request->status_payment,
            'status_shipping' => $request->status_shipping,
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }
}
