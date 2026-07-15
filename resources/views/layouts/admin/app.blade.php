<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-slate-800 font-sans antialiased h-full">

    <div class="flex h-screen overflow-hidden">

        @include('layouts.admin.sidebar')

        <div class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto">

            <div class="p-6 pb-0">
                @include('layouts.admin.navbar')
            </div>

            <main class="flex-1 p-6">
                @yield('content')
            </main>

            <div class="p-6 pt-0 mt-auto">
                @include('layouts.admin.footer')
            </div>

        </div>

    </div>
    @if(session('success'))
        <input type="hidden" id="session-success" value="{{ session('success') }}">
    @endif

    @if(session('error'))
        <input type="hidden" id="session-error" value="{{ session('error') }}">
    @endif

    @if($errors->any())
        <ul id="validation-errors" class="hidden">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const successMsg = document.getElementById('session-success');
            if (successMsg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMsg.value,
                    width: '400px',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#2563eb'
                });
            }

            const errorMsg = document.getElementById('session-error');
            if (errorMsg) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMsg.value,
                    width: '400px',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc2626'
                });
            }

            const errorsList = document.getElementById('validation-errors');
            if (errorsList) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Gagal Disimpan!',
                    width: '400px',
                    html: `
                        <p class="text-sm">Silakan periksa kembali data yang Anda masukkan.</p>
                        <ul style="text-align: left; margin-top: 12px;" class="text-sm text-gray-600 list-disc list-inside space-y-1">
                            ${errorsList.innerHTML}
                        </ul>
                    `,
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#dc2626'
                });
            }

        });
    </script>
</body>

</html>