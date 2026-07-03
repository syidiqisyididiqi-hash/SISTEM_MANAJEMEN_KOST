@props(['user'])

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
                {{ $user->name }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Email
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $user->email }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Nomor Telepon
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $user->phone ?? '-' }}
            </div>
        </div>

        <div>
            <label class="block text-sm text-slate-500 mb-2">
                Role
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ ucfirst($user->role) }}
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm text-slate-500 mb-2">
                Bergabung Sejak
            </label>

            <div class="bg-slate-50 p-3 rounded-xl">
                {{ $user->created_at->format('d F Y') }}
            </div>
        </div>

    </div>

</div>