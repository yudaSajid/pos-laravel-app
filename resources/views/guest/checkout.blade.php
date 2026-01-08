<x-layout.guest>
    <x-slot:title>Checkout</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-black text-slate-900 mb-8">Informasi Pengiriman</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="customer_name" required class="w-full px-5 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Nomor WhatsApp</label>
                        <input type="text" name="phone" placeholder="0812..." required class="w-full px-5 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="4" required class="w-full px-5 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-600 transition shadow-lg">
                        Konfirmasi & Buat Pesanan
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-6">Ringkasan Belanja</h3>
                    <div class="space-y-4">
                        @php $total = 0 @endphp
                        @foreach($cart as $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <div class="flex justify-between items-center text-sm text-slate-600">
                                <span>{{ $details['name'] }} (x{{ $details['quantity'] }})</span>
                                <span class="font-bold text-slate-900">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="border-t border-slate-200 pt-4 mt-4 flex justify-between">
                            <span class="font-black text-slate-900 uppercase text-xs">Total Pembayaran</span>
                            <span class="font-black text-blue-600 text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-4 p-4 bg-blue-50 rounded-2xl border border-blue-100 items-start">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600 mt-0.5"></i>
                    <p class="text-[11px] text-blue-700 leading-relaxed">
                        Dengan menekan tombol di samping, pesanan Anda akan langsung tercatat di sistem kami. Mohon pastikan nomor WhatsApp aktif untuk konfirmasi pembayaran.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>