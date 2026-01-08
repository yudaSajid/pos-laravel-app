<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel as Product;
use App\Models\CategoryModel as Category;
use App\Models\OrderModel as Order;
use App\Models\OrderItemModel as OrderItem;
use Illuminate\Support\Facades\DB;


class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category')->where('stock', '>', 0);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->paginate(12);
        return view('guest.index', compact('products', 'categories'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambah ke keranjang!');
    }

    public function cart()
    {
        return view('guest.cart');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            $product = Product::find($request->id);
            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }

            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Keranjang diperbarui!');
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
        }
    }
    public function checkout()
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->route('products.index');

        return view('guest.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('index')->with('error', 'Keranjang Anda kosong!');
        }

        $newOrder = DB::transaction(function () use ($request, $cart) {
            $total = 0;
            foreach ($cart as $details) {
                $total += $details['price'] * $details['quantity'];
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'shipping_address' => $request->address,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price_at_purchase' => $details['price'],
                ]);

                $product = Product::find($id);
                $product->decrement('stock', $details['quantity']);
            }
            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.success', $newOrder->order_number);
    }
    public function success($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        return view('guest.success', compact('order'));
    }

    public function orderHistory()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('guest.history', compact('orders'));
    }
}
