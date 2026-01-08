<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storefront - POS System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-white font-sans antialiased text-slate-900">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-black text-blue-600 tracking-tighter">STORE.</a>

            <div class="hidden md:flex gap-8 font-medium">
                <a href="{{ route('index') }}" class="hover:text-blue-600">Home</a>
                <a href="#" class="hover:text-blue-600">Categories</a>
                <a href="{{ route('orders.history') }}" class="hover:text-blue-600">My Orders</a>
            </div>

            <div class="flex items-center gap-5">
                <a href="{{ route('cart') }}" class="relative p-2 text-slate-600 hover:text-blue-600 transition">
                    <i data-lucide="shopping-bag"></i>

                    @if (session('cart') && count(session('cart')) > 0)
                        <span
                            class="absolute top-0 right-0 bg-rose-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ array_sum(array_column(session('cart'), 'quantity')) }}
                        </span>
                    @endif
                </a>

                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-medium text-slate-600">Hi, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-rose-600">Keluar</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">
        {{ $slot }}
    </main>

    <footer class="border-t border-slate-100 py-10 text-center text-slate-500 text-sm">
        &copy; 2024 POS System Laravel 11. All rights reserved.
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @if (session('success'))
        <div
            class="fixed bottom-5 right-5 bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center gap-3 animate-bounce">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif
</body>

</html>
