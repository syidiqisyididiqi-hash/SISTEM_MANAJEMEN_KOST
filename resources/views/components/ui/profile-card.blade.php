@props(['user'])

<div class="bg-white rounded-2xl shadow-sm p-6">

    <div class="flex flex-col md:flex-row items-center gap-6">

        <div
            class="w-28 h-28 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-4xl font-bold">

            {{ strtoupper(substr($user->name, 0, 1)) }}

        </div>

        <div class="flex-1">

            <h2 class="text-2xl font-bold text-slate-800">
                {{ $user->name }}
            </h2>

            <p class="text-slate-500">
                {{ $user->email }}
            </p>

            <span class="inline-flex mt-3 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">

                {{ ucfirst($user->role) }}

            </span>

        </div>

    </div>

</div>