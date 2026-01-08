<x-layout.admin>
    <x-slot:title>Ringkasan Bisnis</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                <i data-lucide="wallet" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Revenue (Bulan Ini)</p>
                <h3 class="text-2xl font-bold text-slate-900">Rp {{ number_format($revenueMonth, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Total Pesanan</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ $totalOrders }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center">
                <i data-lucide="package-search" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Perlu Diproses</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ $toProcessCount }} Transaksi</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-500 text-sm font-medium">Pelanggan Baru</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ $newCustomers }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Transaksi Terbaru</h3>
                <a href="{{ route('admin.orders') }}" class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-4">ID Order</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">#{{ $transaction->order_number }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $transaction->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                    {{ $transaction->status_payment == 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $transaction->status_payment == 'paid' ? 'Lunas' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm italic">Belum ada transaksi terbaru</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-800">Antrean Proses</h3>
                <a href="{{ route('admin.orders') }}" class="text-amber-600 text-[10px] font-bold uppercase hover:underline">Lihat semua</a>
            </div>
            
            <div class="space-y-4">
                @forelse($processQueue as $item)
                <div class="group p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-amber-300 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-sm font-bold text-slate-900 uppercase">#{{ $item->order_number }}</p>
                        <span class="text-[10px] text-slate-500">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-slate-600 mb-3">{{ $item->user->name }} - {{ $item->items->count() }} Produk</p>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.orders.show', $item->id) }}" class="flex-1 text-center text-[10px] bg-white py-1.5 rounded-lg border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition">
                            Detail
                        </a>
                        <button onclick="openStatusModal('{{ $item->id }}', '{{ $item->status_payment }}', '{{ $item->status_shipping }}')" 
                            class="flex-1 text-center text-[10px] bg-amber-500 py-1.5 rounded-lg font-bold text-white hover:bg-amber-600 shadow-sm transition">
                            Proses
                        </button>
                        
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-xs text-slate-400 italic">Semua pesanan telah diproses ✨</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <div id="statusModal"
        class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md p-8 shadow-2xl">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Update Status Pesanan</h3>

            <form id="statusForm" action="" method="POST">
                @csrf
                @method('PATCH')

                <div class="space-y-4 text-sm">
                    <div>
                        <label class="block font-bold mb-2">Status Pembayaran</label>
                        <select name="status_payment" id="modalPayment" class="w-full px-4 py-2 border rounded-xl">
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Status Pengiriman</label>
                        <select name="status_shipping" id="modalShipping" class="w-full px-4 py-2 border rounded-xl">
                            <option value="pending">Pending</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 text-slate-500 font-bold uppercase text-xs">Batal</button>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-bold rounded-xl uppercase text-xs shadow-lg shadow-blue-200">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openStatusModal(id, payment, shipping) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');

            let routeUrl = "{{ route('admin.orders.updateStatus', ':id') }}";
            form.action = routeUrl.replace(':id', id);

            document.getElementById('modalPayment').value = payment;
            document.getElementById('modalShipping').value = shipping;

            modal.classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }
    </script>
</x-layout.admin>