<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\HomepageController;
use App\Http\Controllers\Website\TentangKamiController;
use App\Http\Controllers\Website\PembelajaranController;
use App\Http\Controllers\Website\KegiatanController as KegiatanWebsite;
use App\Http\Controllers\Admin\PembelajaranController as AdminPembelajaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/', [HomepageController::class, 'index']);

Route::get('login', function() {
    return redirect('/');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
    return view('website.auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('website.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::prefix('kegiatan')->group(function () {
    Route::get('/', [KegiatanWebsite::class, 'index']);
    Route::get('{id}', [KegiatanWebsite::class, 'details']);
    Route::post('{id}/daftar', [KegiatanWebsite::class, 'daftar'])
        ->middleware('auth')
        ->name('kegiatan.daftar');
});

Route::prefix('e-learning')->group(function () {
    Route::get('/', [PembelajaranController::class, 'index']);
    Route::get('{id}', [PembelajaranController::class, 'details']);
    
    Route::get('{id}/quiz', [PembelajaranController::class, 'quiz'])
        ->middleware('auth');

    Route::post('jawab', [PembelajaranController::class, 'submitJawaban'])
        ->middleware('auth')
        ->name('elearning.jawab');
});

Route::prefix('tentang-kami')->group(function () {
    Route::get('/', [TentangKamiController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('update', [ProfileController::class, 'update'])->name('profile.update');

    });

    Route::prefix('logs')->group(function () {
        Route::get('e-learning', [PembelajaranController::class, 'listPembelajaran']);
        Route::get('kegiatan', [KegiatanWebsite::class, 'listKegiatan']);
    });

    Route::prefix('kelola')->group(function () {
        Route::prefix('kegiatan')->group(function () {
            Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan.index');
            Route::get('create', [KegiatanController::class, 'create']);
            Route::post('store', [KegiatanController::class, 'store'])->name('kegiatan.store');

            Route::get('edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
            Route::put('update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
            Route::delete('destroy/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

            Route::post('getpeserta', [KegiatanController::class, 'getPeserta']);
        });

        Route::prefix('admin')->group(function () {
            Route::get('/', [IndexController::class, 'index'])->name('admin.index');
            Route::get('create', [IndexController::class, 'create'])->name('admin.create');
            Route::post('store', [IndexController::class, 'store'])->name('admin.store');

            Route::get('edit/{id}', [IndexController::class, 'edit'])->name('admin.edit');
            Route::put('update/{id}', [IndexController::class, 'update'])->name('admin.update');
            Route::delete('destroy/{id}', [IndexController::class, 'destroy'])->name('admin.destroy');
        });

        Route::prefix('pembelajaran')->group(function () {
            Route::get('/', [AdminPembelajaranController::class, 'index'])->name('pembelajaran.index');
            Route::get('create', [AdminPembelajaranController::class, 'create'])->name('pembelajaran.create');
            Route::post('store', [AdminPembelajaranController::class, 'store'])->name('pembelajaran.store');

            Route::get('edit/{id}', [AdminPembelajaranController::class, 'edit'])->name('pembelajaran.edit');
            Route::put('update/{id}', [AdminPembelajaranController::class, 'update'])->name('pembelajaran.update');
            Route::delete('destroy/{id}', [AdminPembelajaranController::class, 'destroy'])->name('pembelajaran.destroy');

            // buat quiz
            Route::get('{id}/soal', [SoalController::class, 'index'])->name('soal.index');
            Route::get('{id}/soal/create', [SoalController::class, 'create'])->name('soal.create');
            Route::post('{id}/soal', [SoalController::class, 'store'])->name('soal.store');
            
            Route::get('soal/{id}/edit', [SoalController::class, 'edit'])->name('soal.edit');
            Route::put('soal/{id}/update', [SoalController::class, 'update'])->name('soal.update');
            Route::delete('soal/{id}/destroy', [SoalController::class, 'destroy'])->name('soal.destroy');

        });
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
    });
});
