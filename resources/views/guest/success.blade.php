<x-layout.guest>
    <x-slot:title>Pesanan Berhasil</x-slot>

    <div class="max-w-2xl mx-auto py-20 px-4 text-center">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
            <i data-lucide="check" class="w-10 h-10"></i>
        </div>
        
        <h1 class="text-4xl font-black text-slate-900 mb-4">Pesanan Diterima!</h1>
        <p class="text-slate-500 mb-8">Terima kasih, <span class="font-bold text-slate-900">{{ $order->customer_name }}</span>. Pesanan Anda sedang kami siapkan.</p>

        <div class="bg-white border border-slate-100 rounded-3xl p-8 mb-8 shadow-sm">
            <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Nomor Pesanan Anda</p>
            <h2 class="text-2xl font-mono font-bold text-blue-600">{{ $order->order_number }}</h2>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/62812345678?text=Halo%20Admin%2C%20saya%20ingin%20konfirmasi%20pesanan%20{{ $order->order_number }}" 
               class="px-8 py-4 bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-600 transition shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                <i data-lucide="message-circle" class="w-4 h-4"></i> Konfirmasi via WhatsApp
            </a>
            <a href="{{ route('index') }}" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition">
                Kembali Belanja
            </a>
        </div>
    </div>
</x-layout.guest>