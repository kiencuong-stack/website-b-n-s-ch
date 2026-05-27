<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display shop page with all books
     */
    public function index()
    {
        $books = Book::where('quantity', '>', 0)->paginate(12);
        return view('shop.index', compact('books'));
    }

    /**
     * Display book details
     */
    public function show(Book $book)
    {
        return view('shop.show', compact('book'));
    }

    /**
     * Add book to cart
     */
    public function addToCart(Request $request, Book $book)
    {
        $quantity = $request->input('quantity', 1);

        // Validate quantity
        if ($quantity <= 0 || $quantity > $book->quantity) {
            return redirect()->back()->with('error', 'Số lượng không hợp lệ');
        }

        // Get cart from session
        $cart = session()->get('cart', []);

        // Check if book already in cart
        if (isset($cart[$book->id])) {
            $newQuantity = $cart[$book->id]['quantity'] + $quantity;
            if ($newQuantity > $book->quantity) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho');
            }
            $cart[$book->id]['quantity'] = $newQuantity;
        } else {
            if ($quantity > $book->quantity) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho');
            }
            $cart[$book->id] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'quantity' => $quantity,
            ];
        }

        // Save cart to session
        session()->put('cart', $cart);

        return redirect()->route('shop.cart')->with('success', "Đã thêm '{$book->title}' vào giỏ hàng");
    }

    /**
     * Display shopping cart
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('shop.cart', compact('cart', 'total'));
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request)
    {
        $bookId = $request->input('book_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);
            return redirect()->route('shop.cart')->with('success', 'Đã xóa khỏi giỏ hàng');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tìm thấy');
    }

    /**
     * Update cart quantity
     */
    public function updateCart(Request $request)
    {
        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$bookId])) {
            if ($quantity <= 0) {
                unset($cart[$bookId]);
            } else {
                $cart[$bookId]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('shop.cart')->with('success', 'Cập nhật giỏ hàng thành công');
    }

    /**
     * Display checkout form
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Giỏ hàng trống');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('shop.checkout', compact('cart', 'total'));
    }

    /**
     * Process order
     */
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Giỏ hàng trống');
        }

        // Validate input
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,bank_transfer,credit_card',
            'card_number' => 'required_if:payment_method,credit_card|nullable|digits_between:13,19',
            'card_expiry' => 'required_if:payment_method,credit_card|nullable|regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/',
            'card_cvv' => 'required_if:payment_method,credit_card|nullable|digits_between:3,4',
            'notes' => 'nullable|string|max:500',
        ]);

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $total,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items and update book quantities
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Update book quantity
            $book = Book::find($item['id']);
            $book->update([
                'quantity' => $book->quantity - $item['quantity'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('shop.orderConfirmation', $order->id)
            ->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    /**
     * Display order confirmation
     */
    public function orderConfirmation(Order $order)
    {
        if (! auth()->user()->isAdmin() && auth()->id() !== $order->user_id) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        return view('shop.confirmation', compact('order'));
    }
}
