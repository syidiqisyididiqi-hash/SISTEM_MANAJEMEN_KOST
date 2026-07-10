<nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-xl flex items-center justify-center font-bold shadow-md shadow-blue-200 tracking-wider">
                    T
                </div>
                <div>
                    <h1 class="text-sm font-bold text-gray-900 tracking-tight leading-none mb-1">
                        Tenant Panel
                    </h1>
                    <p class="text-xxs text-gray-400 font-medium tracking-wide uppercase">
                        Sistem Manajemen Kos
                    </p>
                </div>
            </div>

            <button id="menuBtn"
                class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-50 focus:outline-none relative z-50 transition-colors">
                <span id="menuIcon" class="text-xl block w-6 text-center leading-none">☰</span>
            </button>

            <ul class="hidden md:flex items-center gap-1 text-sm font-medium text-gray-600">
                @guest
                    <li>
                        <a href="{{ route('home') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.rooms.index') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Kamar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.announcement.index') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Pengumuman
                        </a>
                    </li>
                    <li class="ml-2">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm shadow-blue-100 transition-all">
                            Login
                        </a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a href="{{ route('tenant.dashboard') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.rooms.index') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Kamar Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.billing.index') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.payment.create') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.payment.history') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all">
                            Riwayat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.profile.index') }}"
                            class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/50 transition-all mr-2">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-3 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg font-semibold transition-all">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>

    <div id="sidebarOverlay"
        class="hidden fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-40 transition-opacity duration-300"></div>

    <div id="mobileMenu"
        class="fixed top-0 left-0 h-screen w-72 bg-white z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between p-6">
        <div>
            <div class="flex items-center gap-3 border-b border-gray-100 pb-5 mb-6">
                <div
                    class="w-9 h-9 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-xl flex items-center justify-center font-bold shadow-md shadow-blue-200">
                    T
                </div>
                <div>
                    <h2 class="font-bold text-gray-900 text-sm leading-none mb-1">
                        Tenant Panel
                    </h2>
                    <p class="text-xxs text-gray-400 font-medium tracking-wide uppercase">
                        Sistem Manajemen Kos
                    </p>
                </div>
            </div>

            <ul class="flex flex-col gap-1 text-sm font-medium text-gray-600">
                @guest
                    <li>
                        <a href="{{ route('home') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.rooms.index') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Kamar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.announcement.index') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Pengumuman
                        </a>
                    </li>
                    <li class="mt-4 px-4">
                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-center shadow-sm shadow-blue-100 transition-all">
                            Login
                        </a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a href="{{ route('tenant.dashboard') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.rooms.index') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Kamar Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.billing.index') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.payment.create') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.payment.history') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Riwayat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.profile.index') }}"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all">
                            Profile
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

        @auth
            <div class="border-t border-gray-100 pt-4">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl transition-all text-sm">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<style>
    .text-xxs {
        font-size: 0.65rem;
    }
</style>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const menuIcon = document.getElementById('menuIcon');
    const mobileMenu = document.getElementById('mobileMenu');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleMenu() {
        const isOpen = !mobileMenu.classList.contains('-translate-x-full');

        if (isOpen) {
            mobileMenu.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            menuIcon.innerText = '☰';
        } else {
            mobileMenu.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            menuIcon.innerText = '✕';
        }
    }

    menuBtn.addEventListener('click', toggleMenu);
    sidebarOverlay.addEventListener('click', toggleMenu);
</script>