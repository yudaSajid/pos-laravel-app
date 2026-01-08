<x-layout.admin>
    <x-slot:title>Laporan Pendapatan</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-bold text-slate-500 mb-4 uppercase tracking-wider">Filter Periode</h3>
            <form action="{{ route('reports.revenue') }}" method="GET" class="space-y-4">
                <div>
                    <select name="month" class="w-full px-4 py-2 rounded-xl border border-slate-200 text-sm">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="w-full py-2 bg-slate-900 text-white rounded-xl font-bold text-sm">Terapkan Filter</button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-emerald-600 p-8 rounded-2xl shadow-lg shadow-emerald-100 flex flex-col justify-center text-white">
            <p class="text-emerald-100 text-sm font-medium mb-1">Total Pendapatan (Paid)</p>
            <h2 class="text-4xl font-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
            <p class="text-emerald-200 text-xs mt-4 italic">*Hanya menghitung transaksi dengan status pembayaran 'Paid'</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Rincian Transaksi Masuk</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Nomor Order</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900 text-sm">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-right font-black text-slate-900 text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400">Tidak ada pendapatan di periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout.admin>