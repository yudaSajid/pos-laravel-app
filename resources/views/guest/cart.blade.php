<x-layout.guest>
    <x-slot:title>Keranjang Belanja</x-slot>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-black text-slate-900 mb-10 flex items-center gap-3">
            <i data-lucide="shopping-cart" class="w-8 h-8 text-blue-600"></i> Keranjang Anda
        </h1>

        @if (session('cart') && count(session('cart')) > 0)
            <div class="flex flex-col lg:flex-row gap-12">

                <div class="flex-1 space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                                <tr>
                                    <th class="px-8 py-5">Produk</th>
                                    <th class="px-8 py-5 text-center">Harga</th>
                                    <th class="px-8 py-5 text-center">Jumlah</th>
                                    <th class="px-8 py-5 text-right">Subtotal</th>
                                    <th class="px-8 py-5"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @php $total = 0 @endphp
                                @foreach (session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr class="group">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 bg-slate-100 rounded-2xl overflow-hidden">
                                                    @if ($details['image'])
                                                        <img src="{{ asset('storage/' . $details['image']) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center text-slate-300">
                                                            <i data-lucide="image" class="w-6 h-6"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-slate-900">{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-center text-slate-600 font-medium">
                                            Rp {{ number_format($details['price'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <div
                                                class="inline-flex items-center border border-slate-200 rounded-xl px-2 py-1 gap-3">
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $details['quantity'] - 1 }}">
                                                    <button type="submit"
                                                        class="text-slate-400 hover:text-blue-600 p-1 {{ $details['quantity'] <= 1 ? 'pointer-events-none opacity-20' : '' }}">
                                                        <i data-lucide="minus" class="w-4 h-4"></i>
                                                    </button>
                                                </form>

                                                <span
                                                    class="font-bold text-slate-900 w-6">{{ $details['quantity'] }}</span>

                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $details['quantity'] + 1 }}">
                                                    <button type="submit"
                                                        class="text-slate-400 hover:text-blue-600 p-1">
                                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-right font-black text-slate-900">
                                            Rp
                                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit"
                                                    class="text-slate-300 hover:text-rose-600 transition">
                                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('index') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Lanjut Belanja
                    </a>
                </div>

                <div class="w-full lg:w-96">
                    <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-2xl sticky top-8">
                        <h3 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-8">Ringkasan Pesanan
                        </h3>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400 font-medium">Subtotal</span>
                                <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400 font-medium">Biaya Admin</span>
                                <span class="text-emerald-400 font-bold">Gratis</span>
                            </div>
                            <div class="border-t border-white/10 pt-4 mt-4 flex justify-between items-end">
                                <span class="text-sm font-bold text-slate-400">Total Harga</span>
                                <span class="text-2xl font-black text-white">Rp
                                    {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                            class="block w-full py-4 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-2xl font-black transition shadow-lg shadow-blue-900/50 uppercase tracking-widest text-xs">
                            Checkout Sekarang
                        </a>

                        <p class="text-[10px] text-slate-500 text-center mt-6">
                            *Pajak dan ongkos kirim akan dihitung saat checkout.
                        </p>
                    </div>
                </div>

            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-100 p-20 text-center shadow-sm">
                <div
                    class="w-24 h-24 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-bag" class="w-12 h-12"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Keranjang Anda masih kosong</h2>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto text-sm leading-relaxed">Sepertinya Anda belum
                    menambahkan produk apapun ke dalam keranjang belanja.</p>
                <a href="{{ route('index') }}"
                    class="inline-flex px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition">Mulai
                    Belanja</a>
            </div>
        @endif
    </div>
</x-layout.guest>
