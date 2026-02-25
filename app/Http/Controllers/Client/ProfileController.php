<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function edit()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $profile = $user->profile()->firstOrCreate(['user_id' => $user->id]);

        return view('client.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileName = Str::uuid() . '.' . $avatar->getClientOriginalExtension();

            // (opsional) hapus avatar lama kalau ada
            if ($user->avatar && Storage::disk('public')->exists('avatar_user/' . $user->avatar)) {
                Storage::disk('public')->delete('avatar_user/' . $user->avatar);
            }

            Storage::disk('public')->putFileAs('avatar_user', $avatar, $fileName);

            // simpan yang ke DB hanya nama filenya, sama kayak logo komunitas kamu
            $data['avatar'] = $fileName;
        }

        $user->update($data);

        Alert::success('sukses', 'Profil berhasil diperbarui');
        return back();
    }

    public function updatePassword(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        Alert::success('Sukses', 'Password berhasil diperbarui.');
        return back();
    }
}
