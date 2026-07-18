<div
    class="md:hidden fixed top-0 left-0 right-0 z-40 px-4 py-3 bg-slate-950/95 backdrop-blur-md text-white flex justify-between items-center border-b border-white/5 shadow-xl">
    <div class="flex items-center gap-2.5">
        <span class="text-xl">🏢</span>
        <span
            class="font-bold text-sm tracking-wider uppercase bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Kost
            Admin</span>
    </div>
    <button id="mobile-sidebar-toggle"
        class="p-2 bg-white/5 hover:bg-white/10 rounded-xl border border-white/10 transition-all duration-200 focus:outline-none">
        <svg id="hamburger-icon" class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg id="close-icon" class="w-5 h-5 hidden text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<div id="sidebar-overlay"
    class="hidden md:hidden fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-30 transition-opacity duration-300"></div>

<aside id="main-sidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-950 text-white px-4 py-6 flex flex-col border-r border-white/5 transform -translate-x-full md:translate-x-0 md:relative md:z-auto transition-transform duration-300 ease-in-out pt-24 md:pt-6 h-screen overflow-hidden">

    <div class="flex items-center gap-3 px-2 mb-5 shrink-0">
        <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-lg shadow-lg shadow-blue-500/20">
            🏢
        </div>
        <div>
            <h1
                class="text-base font-bold tracking-wide bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                Kost Admin</h1>
            <p class="text-xs text-gray-500 font-medium">Management System</p>
        </div>
    </div>

    <div class="bg-white/[0.03] border border-white/5 rounded-xl p-3 mb-5 mx-1 backdrop-blur-md shrink-0">
        <div class="flex items-center gap-3">
            <div
                class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-sm font-bold text-white shadow-md">
                A
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-200">Admin</h3>
                <p class="text-[11px] text-gray-500 font-medium tracking-wide">Administrator</p>
            </div>
        </div>
    </div>

    <nav id="sidebar-nav" class="flex-1 overflow-y-auto space-y-6 px-1 pb-4 style-scrollbar-none"
        style="-ms-overflow-style: none; scrollbar-width: none;">

        <style>
            .style-scrollbar-none::-webkit-scrollbar {
                display: none;
            }
        </style>

        <div>
            <p class="px-2 text-[11px] font-bold tracking-wider text-gray-600 uppercase mb-2.5">Main Menu</p>
            <div class="space-y-1.5">
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150 
                    {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.dashboard') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">🏠</span>
                        <span class="text-[13px] tracking-wide">Dashboard</span>
                    </div>
                </a>

                <a href="{{ route('admin.report') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.report') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.report') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">📊</span>
                        <span class="text-[13px] tracking-wide">Laporan</span>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <p class="px-2 text-[11px] font-bold tracking-wider text-gray-600 uppercase mb-2.5">Kost Management</p>
            <div class="space-y-1.5">
                <a href="{{ route('admin.rooms.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.rooms.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.rooms.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">🛏️</span>
                        <span class="text-[13px] tracking-wide">Data Kamar</span>
                    </div>
                </a>

                <a href="{{ route('admin.tenants.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.tenants.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.tenants.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">👤</span>
                        <span class="text-[13px] tracking-wide">Data Tenant</span>
                    </div>
                </a>

                <a href="{{ route('admin.room-tenants.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.room-tenants.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.room-tenants.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">🔗</span>
                        <span class="text-[13px] tracking-wide">Room Tenant</span>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <p class="px-2 text-[11px] font-bold tracking-wider text-gray-600 uppercase mb-2.5">Finance</p>
            <div class="space-y-1.5">
                <a href="{{ route('admin.bills.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.bills.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.bills.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">🧾</span>
                        <span class="text-[13px] tracking-wide">Tagihan</span>
                    </div>
                </a>

                <a href="{{ route('admin.payments.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.payments.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.payments.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">💳</span>
                        <span class="text-[13px] tracking-wide">Pembayaran</span>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <p class="px-2 text-[11px] font-bold tracking-wider text-gray-600 uppercase mb-2.5">System</p>
            <div class="space-y-1.5">
                <a href="{{ route('admin.users.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.users.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">👥</span>
                        <span class="text-[13px] tracking-wide">User Management</span>
                    </div>
                </a>

                <a href="{{ route('admin.activity-log') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.activity-log') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.activity-log') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">📜</span>
                        <span class="text-[13px] tracking-wide">Activity Log</span>
                    </div>
                </a>

                <a href="{{ route('admin.profile.index') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.profile.*') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.profile.*') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">🧑‍💼</span>
                        <span class="text-[13px] tracking-wide">My Profile</span>
                    </div>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="group flex items-center justify-between px-3 py-2.5 rounded-xl relative transition-all duration-150
                    {{ request()->routeIs('admin.settings') ? 'bg-white/10 text-white font-medium border-l-2 border-blue-500 rounded-l-none' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <div class="flex items-center gap-3">
                        <span
                            class="text-lg {{ request()->routeIs('admin.settings') ? 'scale-110' : 'opacity-70 group-hover:opacity-100' }}">⚙️</span>
                        <span class="text-[13px] tracking-wide">Settings</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <div class="pt-4 mt-auto border-t border-white/5 bg-slate-950 shrink-0">

        <form action="{{ route('logout') }}" method="POST" id="form-logout">

            @csrf

            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 px-4 py-2.5 rounded-xl text-[13px] font-semibold tracking-wide shadow-lg shadow-red-500/10 active:scale-[0.99] transition-all duration-150">

                <span>🚪</span>
                Logout

            </button>

        </form>

    </div>
</aside>

<script>
    const sidebar = document.getElementById('main-sidebar');
    const toggleBtn = document.getElementById('mobile-sidebar-toggle');
    const overlay = document.getElementById('sidebar-overlay');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const navMenu = document.getElementById('sidebar-nav');

    if (navMenu && localStorage.getItem('sidebar-scroll-position')) {
        navMenu.scrollTop = localStorage.getItem('sidebar-scroll-position');
    }

    if (navMenu) {
        const links = navMenu.querySelectorAll('a[href]');
        links.forEach(link => {
            link.addEventListener('click', () => {
                localStorage.setItem('sidebar-scroll-position', navMenu.scrollTop);
            });
        });
    }

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


    const formLogout = document.getElementById('form-logout');
    if (formLogout) {
        formLogout.addEventListener('submit', function (e) {
            e.preventDefault(); // Menahan proses logout langsung

            Swal.fire({
                icon: 'warning', // Menggunakan ikon peringatan
                title: 'Keluar dari Sistem?',
                text: 'Apakah Anda yakin ingin mengakhiri sesi admin saat ini?',
                width: '400px',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626', // Warna merah untuk aksi logout
                cancelButtonColor: '#6b7280',  // Warna abu-abu untuk membatalkan
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Jalankan logout jika klik 'Ya, Keluar'
                }
            });
        });
    }
</script>