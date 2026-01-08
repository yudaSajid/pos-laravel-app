<x-layout.guest>
    <x-slot:title>Riwayat Pesanan Saya</x-slot>

    <div class="max-w-5xl mx-auto py-12 px-4">
        <div class="mb-10">
            <h1 class="text-3xl font-black text-slate-900">Riwayat Pesanan</h1>
            <p class="text-slate-500 mt-2">Daftar seluruh transaksi yang pernah Anda lakukan.</p>
        </div>

        @if($orders->count() > 0)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                        <tr>
                            <th class="px-8 py-5">Info Pesanan</th>
                            <th class="px-8 py-5 text-center">Status Pembayaran</th>
                            <th class="px-8 py-5 text-center">Status Pengiriman</th>
                            <th class="px-8 py-5 text-right">Total Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-6">
                                <span class="block font-bold text-slate-900">#{{ $order->order_number }}</span>
                                <span class="text-xs text-slate-500">{{ $order->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                    {{ $order->status_payment == 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $order->status_payment ?? 'pending' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                    {{ $order->status_shipping == 'delivered' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $order->status_shipping ?? 'pending' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="font-black text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="package-open" class="w-10 h-10"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Belum Ada Pesanan</h3>
                <p class="text-slate-500 text-sm mt-2 mb-8">Anda belum pernah melakukan transaksi apapun.</p>
                <a href="{{ route('index') }}" class="px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</x-layout.guest>