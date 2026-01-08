<x-layout.admin>
    <x-slot:title>Manajemen Pesanan</x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Daftar Pesanan</h3>
                <p class="text-sm text-slate-500">Total {{ $orders->total() }} pesanan tercatat</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">Invoice</th>
                        <th class="px-6 py-4">Pemesan</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4 text-center">Status Pesanan</th>
                        <th class="px-6 py-4 text-center">Status Payment</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($orders as $list)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-bold text-slate-900 text-sm">{{ $list->order_number }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $list->user_id }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">Rp
                                {{ number_format($list->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-md text-[11px] font-bold border capitalize {{ $list->status_shipping > 0 ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                                    {{ $list->status_shipping }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-md text-[11px] font-bold border capitalize {{ $list->status_payment > 0 ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                                    {{ $list->status_payment }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        onclick="openStatusModal('{{ $list->id }}', '{{ $list->status_payment }}', '{{ $list->status_shipping }}')"
                                        class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-tighter">
                                        Kelola
                                    </button>
                                    <a href="{{ route('admin.orders.show', $list->id) }}"
                                        class="text-slate-400 hover:text-slate-900 transition">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100">
            {{ $orders->links() }}
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
