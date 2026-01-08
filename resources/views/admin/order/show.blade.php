<x-layout.admin>
    <x-slot:title>Detail Pesanan #{{ $order->order_number }}</x-slot>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 tracking-tight">Item yang Dibeli</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-slate-400 text-[11px] uppercase tracking-widest font-bold border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Produk</th>
                                <th class="px-6 py-4 text-center">Harga</th>
                                <th class="px-6 py-4 text-center">Qty</th>
                                <th class="px-6 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($order->items as $item)
                            <tr class="text-sm">
                                <td class="px-6 py-4 font-bold text-slate-900">
                                    {{ $item->product->name }}
                                </td>
                                <td class="px-6 py-4 text-center text-slate-600">
                                    Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center font-medium">
                                    x{{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-right font-black text-slate-900">
                                    Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i> Alamat Pengiriman
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    {{ $order->shipping_address }}
                </p>
            </div>
        </div>

        <div class="w-full lg:w-96 space-y-6">
            <div class="bg-slate-900 text-white rounded-2xl p-8 shadow-xl">
                <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-6">Ringkasan Pembayaran</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Total Harga Barang</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Biaya Admin</span>
                        <span class="text-emerald-400">Gratis</span>
                    </div>
                    <hr class="border-slate-800">
                    <div class="flex justify-between items-end pt-2">
                        <span class="text-sm font-bold">Total Bayar</span>
                        <span class="text-2xl font-black text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-800">
                    <p class="text-[10px] text-slate-500 uppercase font-bold mb-3 tracking-widest">Status Saat Ini</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold uppercase">{{ $order->status_payment }}</span>
                        <span class="px-3 py-1 bg-white/10 rounded-full text-[10px] font-bold uppercase">{{ $order->status_shipping }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.orders') }}" class="flex items-center justify-center gap-2 w-full py-4 text-slate-500 font-bold text-sm hover:text-slate-800 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</x-layout.admin>