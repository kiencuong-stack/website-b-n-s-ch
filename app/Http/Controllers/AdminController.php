<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (! $request->user() || $request->user()->role !== 'admin') {
                abort(403, 'Bạn không có quyền truy cập trang quản lý.');
            }

            return $next($request);
        });
    }

    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        
        // Recent orders
        $recentOrders = Order::latest()->take(10)->get();
        
        // Books with low stock
        $lowStockBooks = Book::where('quantity', '<', 10)->get();
        
        // Order statistics
        $orderStats = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBooks',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'lowStockBooks',
            'orderStats'
        ));
    }

    /**
     * Display database overview and quick edit links
     */
    public function database()
    {
        $tableCounts = [
            'books' => Book::count(),
            'users' => User::count(),
            'orders' => Order::count(),
        ];

        return view('admin.database', compact('tableCounts'));
    }

    /**
     * Display books management
     */
    public function books()
    {
        $books = Book::paginate(15);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Display book edit form
     */
    public function editBook(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update book
     */
    public function updateBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'nullable|string|max:100',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:2099',
            'description' => 'nullable|string',
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công');
    }

    /**
     * Delete book
     */
    public function deleteBook(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Xóa sách thành công');
    }

    /**
     * Display users management
     */
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display user details
     */
    public function showUser(User $user)
    {
        $orders = $user->orders()->latest()->paginate(10);
        return view('admin.users.show', compact('user', 'orders'));
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công');
    }

    /**
     * Display orders management
     */
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    public function showOrder(Order $order)
    {
        $order->load('items.book', 'user');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
