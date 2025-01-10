<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\DaftarPembayaranController;
use App\Http\Controllers\LaporanPembayaranController;
use App\Http\Controllers\RiwayatPembayaranController;
use App\Http\Controllers\StaffKepsekProfileController;
use App\Http\Controllers\Auth\RegisteredSiswaController;
use App\Http\Controllers\DashboardStaffAdminController;
use App\Http\Controllers\DashboardStaffKepsekControlller;
use App\Http\Controllers\VerifikasiPembayaranController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        switch ($user->role) {
            case 'siswa':
                return redirect()->route('users.dashboard');
            case 'staffadmin':
                return redirect()->route('dashboard_admin');
            case 'kepsek':
                return redirect()->route('dashboard_kepsek');
            default:
                abort(403, 'Unauthorized action.');
        }
    })->name('dashboard');

    Route::get('/siswa', function () {
        return view('users.dashboard', ['user' => Auth::user()]);
    })->name('users.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/staffadmin', [DashboardStaffAdminController::class, 'index'])->name('dashboard_admin');
    });

    Route::get('/staffkepsek', [DashboardStaffKepsekControlller::class, 'index'])->name('dashboard_kepsek');
});


// Route Role StaffKepsek

Route::get('/datasiswa', [DataSiswaController::class, 'index'])->name('data.siswa.index');
Route::get('/riwayat-laporan', [DashboardStaffKepsekControlller::class, 'laporanPembayaran'])->name('riwayat-laporan');

Route::prefix('profile/staffkepsek')->group(function () {
    Route::get('/', [StaffKepsekProfileController::class, 'edit'])->name('staffkepsek_profile');
    Route::patch('/', [StaffKepsekProfileController::class, 'update'])->name('staffkepsek_profile.update');
    Route::delete('/', [StaffKepsekProfileController::class, 'destroy'])->name('staffkepsek_profile.destroy');
});

// Route Role Siswa

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('users.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/riwayat', [RiwayatPembayaranController::class, 'index'])->name('users.riwayat');
    Route::get('/riwayat-pembayaran/pdf/{tagihanId}', [RiwayatPembayaranController::class, 'unduhPDFPerTransaksi'])->name('riwayat-pembayaran.pdf');
    Route::get('/riwayat-pembayaran/pdf', [RiwayatPembayaranController::class, 'unduhPDF'])->name('riwayat-pembayaran.all.pdf');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tagihan-pembayaran', [TagihanController::class, 'index'])->name('tagihan_pembayaran.index');
    Route::post('/tagihan-pembayaran', [TagihanController::class, 'store'])->name('tagihan_pembayaran.store');
    Route::post('/tagihan-pembayaran-multiple', [TagihanController::class, 'storeMultiple'])->name('tagihan_pembayaran.storeMultiple');
});

// Route untuk Admin

Route::resource('siswas', SiswaController::class);

Route::resource('jenis-pembayaran', JenisPembayaranController::class);

Route::prefix('laporan-pembayaran')->group(function () {
    Route::get('/', [LaporanPembayaranController::class, 'index'])->name('laporan.pembayaran.index');
    Route::get('/result', [LaporanPembayaranController::class, 'generate'])->name('laporan.pembayaran.generate');
});

Route::prefix('verif-pembayaran')->group(function () {
    Route::get('/', [VerifikasiPembayaranController::class, 'index'])->name('verif.pembayaran.index');
    Route::get('/show/{id}', [VerifikasiPembayaranController::class, 'show'])->name('verif.pembayaran.show');
    Route::post('/verif/{id}', [VerifikasiPembayaranController::class, 'verify'])->name('verif.pembayaran.verify');
    Route::put('/verifikasi-pembayaran/reject/{id}', [VerifikasiPembayaranController::class, 'reject'])->name('verif.pembayaran.reject');
});

Route::prefix('profile/admin')->group(function () {
    Route::get('/', [AdminProfileController::class, 'edit'])->name('admin_profile');
    Route::patch('/', [AdminProfileController::class, 'update'])->name('admin_profile.update');
    Route::delete('/', [AdminProfileController::class, 'destroy'])->name('admin_profile.destroy');
});




require __DIR__ . '/auth.php';
