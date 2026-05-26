<nav class="bg-white shadow px-6 py-4">
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
            class="md:hidden text-2xl text-gray-700"
        >
            ☰
        </button>

        <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-700">
            <li>
                <a href="/tenant/dashboard" class="hover:text-blue-600">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-blue-600">
                    Kamar
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-blue-600">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-blue-600">
                    Riwayat
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-blue-600">
                    Bantuan
                </a>
            </li>
        </ul>

    </div>

    <div 
        id="mobileMenu"
        class="hidden md:hidden mt-4 border-t pt-4"
    >
        <ul class="flex flex-col gap-4 text-sm font-medium text-gray-700">

            <li>
                <a href="/tenant/dashboard" class="block hover:text-blue-600">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="#" class="block hover:text-blue-600">
                    Kamar
                </a>
            </li>

            <li>
                <a href="#" class="block hover:text-blue-600">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="#" class="block hover:text-blue-600">
                    Riwayat
                </a>
            </li>

            <li>
                <a href="#" class="block hover:text-blue-600">
                    Bantuan
                </a>
            </li>

        </ul>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>