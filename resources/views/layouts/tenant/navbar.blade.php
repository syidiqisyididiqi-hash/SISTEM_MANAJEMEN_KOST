<nav class="bg-white shadow px-6 py-4 relative z-40">
    <div class="flex items-center justify-between">

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold">
                T
            </div>

            <div>
                <h1 class="text-lg font-bold text-gray-800">
                    Tenant Panel
                </h1>
                <p class="text-xs text-gray-500">
                    Sistem Manajemen Kos
                </p>
            </div>
        </div>

        <button 
            id="menuBtn"
            class="md:hidden text-2xl text-gray-700 focus:outline-none relative z-50 p-2"
        >
            ☰
        </button>

        <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-700">
            <li>
                <a href="/tenant/dashboard" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>🏠</span> Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>🛏️</span> Kamar Saya
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>🧾</span> Tagihan Saya
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>💳</span> Pembayaran
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>📜</span> Riwayat Pembayaran
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>📢</span> Pengumuman
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 hover:text-blue-600 transition-colors">
                    <span>👤</span> Profile
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-1.5 text-red-600 hover:text-red-800 transition-colors border-l pl-4 border-gray-200">
                    <span>🚪</span> Logout
                </a>
            </li>
        </ul>

    </div>

    <div 
        id="sidebarOverlay"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity duration-300"
    ></div>

    <div 
        id="mobileMenu"
        class="fixed top-0 left-0 h-screen w-64 bg-white/85 backdrop-blur-md z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out p-6 flex flex-col justify-between"
    >
        <div>
            <div class="flex items-center gap-3 border-b pb-4 mb-6">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm">
                    T
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-800">Tenant Panel</h2>
                    <p class="text-[10px] text-gray-500">Sistem Manajemen Kos</p>
                </div>
            </div>

            <ul class="flex flex-col gap-4 text-sm font-medium text-gray-700">
                <li>
                    <a href="/tenant/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>🛏️</span> Kamar Saya
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>🧾</span> Tagihan Saya
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>💳</span> Pembayaran
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>📜</span> Riwayat Pembayaran
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>📢</span> Pengumuman
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all">
                        <span>👤</span> Profile
                    </a>
                </li>
            </ul>
        </div>

        <div class="border-t pt-4">
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-800 transition-all font-medium">
                <span>🚪</span> Logout
            </a>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        const isOpen = !mobileMenu.classList.contains('-translate-x-full');

        if (isOpen) {
            mobileMenu.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            menuBtn.innerHTML = '☰';
        } else {
            mobileMenu.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            menuBtn.innerHTML = '✕';
        }
    }

    menuBtn.addEventListener('click', toggleSidebar);

    sidebarOverlay.addEventListener('click', toggleSidebar);
</script>