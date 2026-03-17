<?php

namespace App\Http\Controllers\Website;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile');
        return view('website.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url',
            'pass_sebelumnya' => 'nullable|string',
            'pass_baru' => 'nullable|string|min:6',
            'pass_konfirmasi' => 'nullable|string|same:pass_baru',
        ]);

        $user = Auth::user();

        if ($request->filled('pass_sebelumnya') || $request->filled('pass_baru') || $request->filled('pass_konfirmasi')) {
            if (!Hash::check($request->pass_sebelumnya, $user->password)) {
                return back()->withErrors(['pass_sebelumnya' => 'Password sebelumnya salah.']);
            }

            // Ganti password
            $user->password = Hash::make($request->pass_baru);
        }

        // Update nama di tabel users
        $user->name = $request->name;
        $user->save();

        // Update/insert data profile
        $profile = $user->profile ?? new UserProfile();
        $profile->user_id = $user->id;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->jenis_kelamin = $request->gender;
        $profile->no_telp = $request->phone;
        $profile->alamat = $request->address;
        $profile->status = $request->status;
        $profile->profile_linkedin = $request->linkedin;
        $profile->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

}
