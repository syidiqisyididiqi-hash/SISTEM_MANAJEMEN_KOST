<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .tenant-alert-popup {
            width: min(320px, calc(100vw - 32px)) !important;
            min-height: 180px;
        }
    </style>
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

    @if(session('success'))
        <input type="hidden" id="session-success" value="{{ session('success') }}">
    @elseif(session('error'))
        <input type="hidden" id="session-error" value="{{ session('error') }}">
    @elseif($errors->any())
        <ul id="validation-errors" class="hidden">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('session-success');
            const errorMessage = document.getElementById('session-error');
            const validationErrors = document.getElementById('validation-errors');

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMessage.value,
                    width: '320px',
                    padding: '1.25em',
                    customClass: { popup: 'tenant-alert-popup' },
                    confirmButtonColor: '#4f46e5'
                });
            } else if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage.value,
                    width: '320px',
                    padding: '1.25em',
                    customClass: { popup: 'tenant-alert-popup' },
                    confirmButtonColor: '#dc2626'
                });
            } else if (validationErrors) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Gagal Disimpan',
                    html: validationErrors.innerHTML,
                    width: '320px',
                    padding: '1.25em',
                    customClass: { popup: 'tenant-alert-popup' },
                    confirmButtonColor: '#dc2626'
                });
            }
        });
    </script>

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
