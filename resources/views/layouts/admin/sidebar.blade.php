<aside
    class="w-64 min-h-screen bg-gradient-to-b from-slate-950 via-gray-900 to-slate-950 text-white px-5 py-5 flex flex-col justify-between shadow-2xl border-r border-white/10">

    <div>

        <div class="flex items-center gap-3 mb-8">

            <div
                class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-lg shadow-lg shadow-blue-500/30">
                🏢
            </div>

            <div>
                <h1 class="text-lg font-bold tracking-wide">
                    Kost Admin
                </h1>

                <p class="text-xs text-gray-400">
                    Management System
                </p>
            </div>

        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-3 mb-6 backdrop-blur-xl">

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-sm font-bold">
                    A
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white">
                        Admin
                    </h3>

                    <p class="text-xs text-gray-400">
                        Administrator
                    </p>
                </div>

            </div>

        </div>

        <nav class="space-y-1.5">

            <a href="{{ route('admin.dashboard') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/20 hover:scale-[1.01] transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>🏠</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </div>

                <span class="text-sm opacity-70 group-hover:translate-x-1 transition">
                    →
                </span>

            </a>

            <a href="{{ route('admin.tenant') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>👤</span>
                    <span class="text-sm">Data Tenant</span>
                </div>

            </a>

            <a href="{{ route('admin.rooms.index') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>🛏️</span>
                    <span class="text-sm">Data Kamar</span>
                </div>

            </a>

            <a href="{{ route('admin.room-tenant') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>🔗</span>
                    <span class="text-sm">Room Tenant</span>
                </div>

            </a>

            <a href="{{ route('admin.payment') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>💳</span>
                    <span class="text-sm">Pembayaran</span>
                </div>

            </a>

            <a href="{{ route('admin.bill') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>🧾</span>
                    <span class="text-sm">Tagihan</span>
                </div>

            </a>

            <a href="{{ route('admin.report') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>📊</span>
                    <span class="text-sm">Laporan</span>
                </div>

            </a>

            <a href="{{ route('admin.activity-log') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>📜</span>
                    <span class="text-sm">Activity Log</span>
                </div>

            </a>

            <a href="{{ route('admin.user.index') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>👥</span>
                    <span class="text-sm">User Management</span>
                </div>

            </a>

            <a href="{{ route('admin.settings') }}"
                class="group flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300">

                <div class="flex items-center gap-3">
                    <span>⚙️</span>
                    <span class="text-sm">Settings</span>
                </div>

            </a>

        </nav>

    </div>

    <div class="pt-5 border-t border-white/10">

        <a href="{{ route('login') }}"
            class="flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 px-4 py-3 rounded-xl text-sm font-medium shadow-lg shadow-red-500/20 transition-all duration-300">

            <span>🚪</span>

            Logout

        </a>

    </div>

</aside>