<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryModel as Category;
use App\Models\ProductModel as Product;
use App\Models\OrderModel as Order;
use App\Models\OrderItemModel as OrderItem;
use App\Models\User;

class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Buku', 'Phone', 'Laptop'];
        foreach ($categories as $cat) {
            $category = Category::create(['name' => $cat, 'slug' => str($cat)->slug()]);

            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $cat . " Contoh " . $i,
                    'description' => "Deskripsi untuk produk " . $cat,
                    'price' => rand(10000, 100000),
                    'stock' => rand(10, 50),
                ]);
            }
        }

        $customers = User::where('role', 'customer')->get();
        $products = Product::all();

        for ($i = 1; $i <= 10; $i++) {
            $order = Order::create([
                'user_id' => $customers->random()->id,
                'order_number' => 'INV-' . now()->format('Ymd') . rand(100, 999),
                'total_price' => 0, 
                'status_payment' => collect(['pending', 'paid'])->random(),
                'status_shipping' => collect(['pending', 'shipped', 'delivered'])->random(),
                'shipping_address' => 'Alamat Pengiriman Dummy No. ' . $i,
            ]);

            $totalPrice = 0;
            $itemsCount = rand(1, 3);
            for ($j = 0; $j < $itemsCount; $j++) {
                $product = $products->random();
                $qty = rand(1, 2);
                $price = $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price_at_purchase' => $price
                ]);
                $totalPrice += ($price * $qty);
            }

            $order->update(['total_price' => $totalPrice]);
        }
    }
}
