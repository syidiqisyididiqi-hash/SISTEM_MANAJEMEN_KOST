<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Panel</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <div class="flex-1 flex flex-col">

            @include('layouts.tenant.navbar')

            <main class="p-6 flex-1">
                @yield('content')
            </main>

            @include('layouts.tenant.footer')

        </div>

    </div>

    <script>
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileBackdrop = document.getElementById('mobile-menu-backdrop');

        function toggleMobileMenu() {
            if (!mobileMenu || !mobileBackdrop) return;
            const isHidden = mobileMenu.classList.contains('-translate-x-full');
            mobileMenu.classList.toggle('-translate-x-full', !isHidden);
            mobileBackdrop.classList.toggle('opacity-100', isHidden);
            mobileBackdrop.classList.toggle('pointer-events-none', !isHidden);
        }

        menuToggle?.addEventListener('click', toggleMobileMenu);
        mobileBackdrop?.addEventListener('click', toggleMobileMenu);

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (!mobileMenu || !mobileBackdrop) return;
                mobileMenu.classList.add('-translate-x-full');
                mobileBackdrop.classList.add('pointer-events-none', 'opacity-0');
            });
        });
    </script>

</body>

</html>