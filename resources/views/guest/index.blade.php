<x-layout.guest>
    <x-slot:title>Katalog Produk</x-slot>

    <div class="mb-12 text-center">
        <h1 class="text-4xl font-black text-slate-900 mb-4">Temukan Produk Favorit Anda</h1>
        <form action="{{ route('index') }}" method="GET" class="max-w-xl mx-auto flex gap-2">
            <input type="text" name="search" placeholder="Cari nama barang..." value="{{ request('search') }}"
                class="w-full px-6 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </form>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
        <a href="{{ route('index') }}"
            class="px-5 py-2 rounded-full text-sm font-bold transition {{ !request('category') ? 'bg-slate-900 text-white' : 'bg-white border text-slate-600 hover:bg-slate-50' }}">
            Semua
        </a>
        @foreach ($categories as $cat)
            <a href="{{ route('index', ['category' => $cat->slug]) }}"
                class="px-5 py-2 rounded-full text-sm font-bold transition {{ request('category') == $cat->slug ? 'bg-slate-900 text-white' : 'bg-white border text-slate-600 hover:bg-slate-50' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div
                class="group bg-white rounded-3xl border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-slate-200 transition duration-300">
                <div class="relative aspect-square overflow-hidden bg-slate-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i data-lucide="image" class="w-12 h-12"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black uppercase text-slate-900 shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-slate-900 mb-2 truncate">{{ $product->name }}</h3>
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-lg font-black text-blue-600">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-blue-600 transition shadow-lg active:scale-95">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-slate-400 italic">Produk tidak ditemukan...</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $products->links() }}
    </div>
</x-layout.guest>
