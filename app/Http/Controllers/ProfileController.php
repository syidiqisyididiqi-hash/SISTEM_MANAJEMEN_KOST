<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    /**
     *
     */
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('admin.profile.edit', compact('user'));
    }

    public function tenantEdit()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('tenant.profile.edit', compact('user'));
    }

    /**
     *
     */
    public function changePassword()
    {
        $user = Auth::user();

        return view('admin.profile.change-password', compact('user'));
    }

    /**
     *
     */
   public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'identity_number' => 'nullable|string|max:50',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $tenant = $user->tenant()->first();

        if ($tenant) {
            $tenant->update([
                'phone' => $validated['phone'] ?? null,
                'identity_number' => $validated['identity_number'] ?? null,
            ]);
        } else {
            $user->tenant()->create([
                'phone' => $validated['phone'] ?? null,
                'identity_number' => $validated['identity_number'] ?? null,
                'address' => null,
            ]);
        }

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function tenantUpdate(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'identity_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->tenant()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'] ?? null,
                'identity_number' => $validated['identity_number'] ?? null,
                'address' => $validated['address'] ?? null,
            ]
        );

        return redirect()
            ->route('tenant.profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
