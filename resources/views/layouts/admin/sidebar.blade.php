<div
    class="md:hidden fixed top-0 left-0 right-0 z-40 px-4 py-3 bg-gradient-to-r from-slate-950 to-gray-900 text-white flex justify-between items-center border-b border-white/10 shadow-lg">
    <div class="flex items-center gap-2">
        <span class="text-xl">🏢</span>
        <span class="font-bold text-sm tracking-wide">Kost Admin</span>
    </div>
    <button id="mobile-sidebar-toggle"
        class="p-2 hover:bg-white/10 rounded-lg border border-white/10 hover:border-white/20 focus:outline-none transition-all duration-200">
        <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<div id="sidebar-overlay"
    class="hidden md:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-30 transition-opacity duration-300"></div>

<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-slate-950 via-gray-900 to-slate-950 text-white px-5 py-5 flex flex-col justify-between shadow-2xl border-r border-white/10 transform -translate-x-full md:translate-x-0 md:relative md:z-auto transition-transform duration-300 ease-in-out pt-20 md:pt-5">

    <div>
        <div class="flex items-center gap-3 mb-6">
            <div
                class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-lg shadow-lg shadow-blue-500/30">
                🏢
            </div>
            <div>
                <h1 class="text-lg font-bold tracking-wide">Kost Admin</h1>
                <p class="text-xs text-gray-400">Management System</p>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-3 mb-6 backdrop-blur-xl">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-sm font-bold shadow-md">
                    A
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white">Admin</h3>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
        </div>

        <nav class="space-y-6 overflow-y-auto max-h-[calc(100vh-220px)] pr-1"
            style="-ms-overflow-style: none; scrollbar-width: none;">

            <div>
                <p class="px-3 text-[10px] font-bold tracking-wider text-gray-500 uppercase mb-2">Main Menu</p>
                <div class="space-y-1">

                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200 
                        {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🏠</span>
                            <span class="text-sm font-medium">Dashboard</span>
                        </div>
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="text-sm opacity-70 group-hover:translate-x-1 transition duration-200">→</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.report') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.report') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">📊</span>
                            <span class="text-sm font-medium">Laporan</span>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <p class="px-3 text-[10px] font-bold tracking-wider text-gray-500 uppercase mb-2">Kost Management</p>
                <div class="space-y-1">

                    <a href="{{ route('admin.rooms.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.rooms.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🛏️</span>
                            <span class="text-sm font-medium">Data Kamar</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.tenants.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.tenants.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">👤</span>
                            <span class="text-sm font-medium">Data Tenant</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.room-tenants.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.room-tenants.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🔗</span>
                            <span class="text-sm font-medium">Room Tenant</span>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <p class="px-3 text-[10px] font-bold tracking-wider text-gray-500 uppercase mb-2">Finance</p>
                <div class="space-y-1">

                    <a href="{{ route('admin.bills.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.bills.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">🧾</span>
                            <span class="text-sm font-medium">Tagihan</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.payments.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.payments.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">💳</span>
                            <span class="text-sm font-medium">Pembayaran</span>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <p class="px-3 text-[10px] font-bold tracking-wider text-gray-500 uppercase mb-2">System</p>
                <div class="space-y-1">

                    <a href="{{ route('admin.user.index') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.user.*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">👥</span>
                            <span class="text-sm font-medium">User Management</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.activity-log') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.activity-log') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">📜</span>
                            <span class="text-sm font-medium">Activity Log</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.settings') }}"
                        class="group flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
                        {{ request()->routeIs('admin.settings') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-500/20 hover:scale-[1.01]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">⚙️</span>
                            <span class="text-sm font-medium">Settings</span>
                        </div>
                    </a>
                </div>
            </div>

        </nav>
    </div>

    <div class="pt-4 mt-4 border-t border-white/10">
        <a href="{{ route('login') }}"
            class="flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 px-4 py-2.5 rounded-xl text-sm font-medium shadow-lg shadow-red-500/20 hover:scale-[1.01] transition-all duration-200">
            <span>🚪</span>
            Logout
        </a>
    </div>
</aside>

<script>
    const sidebar = document.getElementById('main-sidebar');
    const toggleBtn = document.getElementById('mobile-sidebar-toggle');
    const overlay = document.getElementById('sidebar-overlay');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    }

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);

        const sidebarLinks = sidebar.querySelectorAll('a[href]');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    }
</script>