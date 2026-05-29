<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        @include('layouts.admin.sidebar')

        <div class="flex-1 p-6">
            @include('layouts.admin.navbar')

            <main class="mt-6">
                @yield('content')
            </main>

            @include('layouts.admin.footer')

        </div>

    </div>

</body>
</html>