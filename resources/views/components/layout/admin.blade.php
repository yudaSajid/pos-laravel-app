<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - POS System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 flex items-center gap-3 text-white border-b border-slate-800">
                <i data-lucide="package" class="text-blue-500"></i>
                <span class="text-xl font-bold tracking-wider">Olshop Saya</span>
            </div>
            <nav class="flex-1 mt-4 px-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.products') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.products*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="box" class="w-5 h-5"></i> Inventori
                </a>

                <a href="{{ route('admin.orders') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.orders*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i> Pesanan
                </a>

                <a href="{{ route('reports.revenue') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition {{ request()->routeIs('admin.reports*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Laporan Revenue
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
                <h2 class="text-lg font-semibold text-slate-800">{{ $title ?? 'Dashboard' }}</h2>
                <div class="flex items-center gap-6">
                    <a href="{{ route('index') }}" target="_blank"
                        class="flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Lihat Toko
                    </a>

                    <div class="w-px h-6 bg-slate-200"></div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest">{{ Auth::user()->role }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-10 h-10 bg-slate-50 text-rose-600 rounded-xl flex items-center justify-center hover:bg-rose-50 transition border border-slate-100">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
