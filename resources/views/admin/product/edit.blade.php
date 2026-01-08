<x-layout.admin>
    <x-slot:title>Edit Produk: {{ $product->name }}</x-slot>

    <div class="max-w-4xl bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="category_id"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Jual (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Foto Produk</label>

                    @if (isset($product) && $product->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-32 h-32 object-cover rounded-xl border">
                        </div>
                    @endif

                    <input type="file" name="image"
                        class="w-full px-4 py-2 rounded-xl border border-slate-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('admin.products') }}"
                    class="px-6 py-2.5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Perbarui
                    Produk</button>
            </div>
        </form>
    </div>
</x-layout.admin>
