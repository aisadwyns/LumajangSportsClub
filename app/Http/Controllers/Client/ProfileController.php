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

        return view('client.profile.index', compact('user', 'profile'));
    }


public function update(Request $request, $id)
{
    // Jika kamu menggunakan parameter manual ($id), Laravel akan mengirimkan ID dari $profile->id tadi.
    $userId = Auth::id();
    $request->validate([
        'first_name' => 'required|string|max:255',
        'phone'      => 'required',
        'avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // 1. Ambil data user yang sedang login
    $user = User::findOrFail($userId);

    // 2. Gabungkan kembali nama depan dan belakang
    $fullName = trim($request->first_name . ' ' . $request->last_name);
    $user->update([
        'name' => $fullName
    ]);

    // 3. Ambil data profil berdasarkan ID yang dikirim atau langsung dari user login
    $profile = Profile::findOrFail($id);

    // Proses upload avatar jika ada file baru
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/avatar_user', $filename);

        // Simpan nama file baru ke object profile
        $profile->avatar = $filename;
    }

    // 4. Update sisa field lainnya
    $profile->phone = $request->phone;
    $profile->address = $request->address;
    $profile->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
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
