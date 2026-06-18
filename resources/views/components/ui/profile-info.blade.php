@php
    $profile = [
        'nama' => 'Muhammad Syahid',
        'email' => 'admin@kost.com',
        'telepon' => '081234567890',
        'role' => 'Administrator',
        'bergabung' => '15 Juni 2026',
    ];
@endphp

<div class="bg-white rounded-2xl shadow-sm p-6">

    <h3 class="text-xl font-bold text-slate-800 mb-6">
        Informasi Profil
    </h3>

    <div class="grid md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Nama Lengkap
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $profile['nama'] }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Email
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $profile['email'] }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Nomor Telepon
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $profile['telepon'] }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Role
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $profile['role'] }}
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm text-slate-500 mb-2">
                Bergabung Sejak
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $profile['bergabung'] }}
            </div>
        </div>

    </div>

</div>