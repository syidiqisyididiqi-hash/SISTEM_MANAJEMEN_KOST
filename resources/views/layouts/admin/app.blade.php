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

</body>

</html>