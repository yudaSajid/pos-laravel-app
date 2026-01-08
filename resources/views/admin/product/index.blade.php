<x-layout.admin>
    <x-slot:title>Manajemen Inventori</x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Daftar Produk</h3>
                <p class="text-sm text-slate-500">Total {{ $products->total() }} produk terdaftar</p>
            </div>
            <a href="{{ route('admin.create') }}"
                class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 hover:bg-slate-800 transition">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if (isset($product) && $product->image)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="w-10 h-10 object-cover rounded-xl border">
                                        </div>
                                    @else
                                    <div
                                        class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <i data-lucide="image" class="w-5 h-5"></i>
                                    </div>
                                    @endif
                                    <span class="font-bold text-slate-900 text-sm">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-900">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-md text-[11px] font-bold border {{ $product->stock > 0 ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                                    {{ $product->stock }} Unit
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.edit', $product->id) }}"
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                        title="Edit Produk">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>

                                    <form action="{{ route('admin.deestroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                            title="Hapus Produk">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100">
            {{ $products->links() }}
        </div>
    </div>
</x-layout.admin>
