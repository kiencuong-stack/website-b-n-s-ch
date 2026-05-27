<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all orders (admin)
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * Cancel order
     */
    public function cancel(Order $order)
    {
        if ($order->status === 'cancelled') {
            return redirect()->back()->with('error', 'Đơn hàng đã bị hủy');
        }

        // Restore book quantities
        foreach ($order->items as $item) {
            $item->book->update([
                'quantity' => $item->book->quantity + $item->quantity,
            ]);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order)->with('success', 'Đơn hàng đã bị hủy');
    }

    /**
     * Dashboard with statistics
     */
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $recentOrders = Order::latest()->limit(10)->get();

        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalRevenue', 'recentOrders'));
    }
}
