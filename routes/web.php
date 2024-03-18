<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfesiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\KategoriStatusController;
use App\Http\Controllers\BidangPekerjaanController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\KategoriDokumenController;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\StatusDokumenController;
use App\Http\Controllers\SuratMenyuratController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login.store');
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');
Route::get('/cetak', [\App\Http\Controllers\PenggajianManualController::class, 'createPDF'])->name('createPDF');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    return redirect('/');
})->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::POST('/buat_password', [\App\Http\Controllers\HomeController::class, 'buat_password'])->name('buat_password');
    Route::POST('/ubah_password', [\App\Http\Controllers\HomeController::class, 'ubah_password'])->name('ubah_password');
    
    Route::controller(HakAksesController::class)->middleware('cek_login:hakakses.index')->group(function () {
        Route::get('/hakakses', 'index')->name('hakakses.index');
        Route::get('/hakakses/edit/{id}', 'edit');
        Route::get('/hakakses/delete/{id}', 'delete');
        Route::get('/hakakses/modul_akses/{id}', 'modul_akses');
        Route::post('/hakakses/modul_akses', 'modul_akses_store');
        Route::post('/hakakses/store', 'store');
        Route::post('/hakakses/update', 'update');
    });
    Route::controller(MenuController::class)->middleware('cek_login:menu.index')->group(function () {
        Route::get('/menu', 'index')->name('menu.index');
        Route::get('/menu/edit/{id}', 'edit');
        Route::get('/menu/status/{id}', 'status');
        Route::get('/menu/delete/{id}', 'delete');
        Route::post('/menu/store', 'store');
        Route::post('/menu/update', 'update');
    });
    Route::controller(StrukturController::class)->middleware('cek_login:struktur.index')->group(function () {
        Route::get('/struktur', 'index')->name('struktur.index');
        Route::get('/struktur/edit/{id}', 'edit');
        Route::get('/struktur/status/{id}', 'status');
        Route::get('/struktur/delete/{id}', 'delete');
        Route::post('/struktur/store', 'store');
        Route::post('/struktur/update', 'update');
    });
    Route::controller(LokasiController::class)->middleware('cek_login:lokasi.index')->group(function () {
        Route::get('/lokasi', 'index')->name('lokasi.index');
        Route::get('/lokasi/edit/{id}', 'edit');
        Route::get('/lokasi/status/{id}', 'status');
        Route::get('/lokasi/delete/{id}', 'delete');
        Route::post('/lokasi/store', 'store');
        Route::post('/lokasi/update', 'update');
    });
    Route::controller(UserController::class)->middleware('cek_login:user.index')->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/delete/{id}', 'delete');
        Route::post('/user/store', 'store');
        Route::post('/user/updateUser', 'updateUser');
        Route::get('/user/editUser/{id}', 'editUser');
        Route::get('/user/edit/{id}', 'edit');
        Route::post('/user/update', 'update');
    });
    Route::controller(BagianController::class)->middleware('cek_login:bagian.index')->group(function () {
        Route::get('/bagian', 'index')->name('bagian.index');
        Route::get('/bagian/sync', 'sync');
    });
    Route::controller(ProfesiController::class)->middleware('cek_login:profesi.index')->group(function () {
        Route::get('/profesi', 'index')->name('profesi.index');
        Route::get('/profesi/sync', 'sync');
    });
    Route::controller(PegawaiController::class)->middleware('cek_login:pegawai.index')->group(function () {
        Route::get('/pegawai', 'index')->name('pegawai.index');
        Route::get('/pegawai/cek_satusehat/{id}', 'cek_satusehat');
        Route::get('/pegawai/edit/{id}', 'edit');
        Route::get('/pegawai/add', 'add');
        Route::get('/pegawai/export', 'export');
        Route::get('/pegawai/sync', 'sync');
        Route::get('/pegawai/sync_satusehat', 'sync_satusehat');
        Route::post('/pegawai/store', 'store');
        Route::post('/pegawai/update_data_diri', 'update_data_diri');
        Route::post('/pegawai/tambah_keluarga', 'tambah_keluarga');
        Route::post('/pegawai/update_alamat', 'update_alamat');
        Route::post('/pegawai/tambah_pendidikan', 'tambah_pendidikan');
        Route::post('/pegawai/tambah_pekerjaan', 'tambah_pekerjaan');
        Route::post('/pegawai/tambah_pelatihan', 'tambah_pelatihan');
        Route::get('/pegawai/hapus_pendidikan/{id}', 'hapus_pendidikan');
        Route::get('/pegawai/hapus_keluarga/{id}', 'hapus_keluarga');
        Route::get('/pegawai/hapus_pekerjaan/{id}', 'hapus_pekerjaan');
        Route::get('/pegawai/hapus_pelatihan/{id}', 'hapus_pelatihan');
        Route::get('/pegawai/table_keluarga/{id}', 'table_keluarga');
        Route::get('/pegawai/table_pendidikan/{id}', 'table_pendidikan');
        Route::get('/pegawai/table_riwayat_pekerjaan/{id}', 'table_riwayat_pekerjaan');
        Route::get('/pegawai/table_pelatihan/{id}', 'table_pelatihan');
        Route::get('/pegawai/hapus_pegawai/{id}', 'hapus_pegawai');
        Route::post('/pegawai/update', 'update');
    });
    Route::controller(KategoriStatusController::class)->middleware('cek_login:kategori_status.index')->group(function () {
        Route::get('/kategori_status', 'index')->name('kategori_status.index');
        Route::get('/kategori_status/sync', 'sync');
        Route::post('/kategori_status/store', 'store');
        Route::post('/kategori_status/update', 'update');
        Route::get('/kategori_status/edit/{id}', 'edit');
        Route::get('/kategori_status/delete/{id}', 'delete');
    });
    Route::controller(BidangPekerjaanController::class)->middleware('cek_login:bidang_pekerjaan.index')->group(function () {
        Route::get('/bidang_pekerjaan', 'index')->name('bidang_pekerjaan.index');
        Route::get('/bidang_pekerjaan/sync', 'sync');
        Route::post('/bidang_pekerjaan/store', 'store');
        Route::post('/bidang_pekerjaan/update', 'update');
        Route::get('/bidang_pekerjaan/edit/{id}', 'edit');
        Route::get('/bidang_pekerjaan/delete/{id}', 'delete');
    });
    Route::controller(KategoriDokumenController::class)->middleware('cek_login:kategori_dokumen.index')->group(function () {
        Route::get('/kategori_dokumen', 'index')->name('kategori_dokumen.index');
        Route::get('/kategori_dokumen/sync', 'sync');
        Route::post('/kategori_dokumen/store', 'store');
        Route::post('/kategori_dokumen/update', 'update');
        Route::get('/kategori_dokumen/edit/{id}', 'edit');
        Route::get('/kategori_dokumen/delete/{id}', 'delete');
    });
    Route::controller(KategoriSuratController::class)->middleware('cek_login:kategori_surat.index')->group(function () {
        Route::get('/kategori_surat', 'index')->name('kategori_surat.index');
        Route::get('/kategori_surat/sync', 'sync');
        Route::post('/kategori_surat/store', 'store');
        Route::post('/kategori_surat/update', 'update');
        Route::get('/kategori_surat/edit/{id}', 'edit');
        Route::get('/kategori_surat/delete/{id}', 'delete');
    });
    Route::controller(StatusDokumenController::class)->middleware('cek_login:status_dokumen.index')->group(function () {
        Route::get('/status_dokumen', 'index')->name('status_dokumen.index');
        Route::get('/status_dokumen/sync', 'sync');
        Route::post('/status_dokumen/store', 'store');
        Route::post('/status_dokumen/update', 'update');
        Route::get('/status_dokumen/edit/{id}', 'edit');
        Route::get('/status_dokumen/delete/{id}', 'delete');
    });
    Route::controller(DepartementController::class)->middleware('cek_login:departement.index')->group(function () {
        Route::get('/departement', 'index')->name('departement.index');
        Route::get('/departement/sync', 'sync');
        Route::post('/departement/store', 'store');
        Route::post('/departement/update', 'update');
        Route::get('/departement/edit/{id}', 'edit');
        Route::get('/departement/delete/{id}', 'delete');
    });
    Route::controller(CalendarController::class)->middleware('cek_login:calendar.index')->group(function () {
        Route::get('/calendar', 'index')->name('calendar.index');
        Route::get('/calendar/sync', 'sync');
        Route::post('/calendar/store', 'store');
        Route::post('/calendar/update', 'update');
        Route::get('/calendar/edit/{id}', 'edit');
        Route::get('/calendar/delete/{id}', 'delete');
    });
    Route::controller(ProyekController::class)->middleware('cek_login:proyek.index')->group(function () {
        Route::get('/proyek', 'index')->name('proyek.index');
        Route::get('/proyek/sync', 'sync');
        Route::post('/proyek/store', 'store');
        Route::post('/proyek/update', 'update');
        Route::get('/proyek/edit/{id}', 'edit');
        Route::get('/proyek/delete/{id}', 'delete');
        Route::get('/proyek/detail/{id}', 'detail');
    });
    Route::controller(SuratMenyuratController::class)->middleware('cek_login:surat_menyurat.index')->group(function () {
        Route::get('/surat_menyurat', 'index')->name('surat_menyurat.index');
        Route::get('/surat_menyurat/sync', 'sync');
        Route::post('/surat_menyurat/store', 'store');
        Route::post('/surat_menyurat/update', 'update');
        Route::get('/surat_menyurat/edit/{id}', 'edit');
        Route::get('/surat_menyurat/doc/{id}', 'doc');
        Route::post('/surat_menyurat/store_doc', 'store_doc');
        Route::get('/surat_menyurat/delete/{id}', 'delete');
        Route::get('/surat_menyurat/delete_doc/{id}', 'delete_doc');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/sync', 'sync');
        Route::post('/profile/alamat', 'alamat');
        Route::post('/profile/kontak', 'kontak');
        Route::post('/profile/updateProfile', 'updateProfile');
        Route::post('/profile/update_data_diri', 'update_data_diri');
        Route::post('/profile/tambah_keluarga', 'tambah_keluarga');
        Route::post('/profile/update_alamat', 'update_alamat');
        Route::post('/profile/tambah_pendidikan', 'tambah_pendidikan');
        Route::post('/profile/tambah_pekerjaan', 'tambah_pekerjaan');
        Route::post('/profile/tambah_pelatihan', 'tambah_pelatihan');
        Route::get('/profile/hapus_pendidikan/{id}', 'hapus_pendidikan');
        Route::get('/profile/hapus_keluarga/{id}', 'hapus_keluarga');
        Route::get('/profile/hapus_pekerjaan/{id}', 'hapus_pekerjaan');
        Route::get('/profile/hapus_pelatihan/{id}', 'hapus_pelatihan');
        Route::get('/profile/table_keluarga/{id}', 'table_keluarga');
        Route::get('/profile/table_pendidikan/{id}', 'table_pendidikan');
        Route::get('/profile/table_riwayat_pekerjaan/{id}', 'table_riwayat_pekerjaan');
        Route::get('/profile/table_pelatihan/{id}', 'table_pelatihan');
    });
    Route::group(['middleware' => ['cek_login:User']], function () {
        // Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');
        // Route::get('/profesi', [\App\Http\Controllers\User\ProfesiController::class, 'index'])->name('profesi');
        // Route::get('/pekerjaan', [\App\Http\Controllers\User\PekerjaanController::class, 'index'])->name('pekerjaan');
        // Route::get('/pelatihan', [\App\Http\Controllers\User\PelatihanController::class, 'index'])->name('pelatihan');
        // Route::get('/kinerja', [\App\Http\Controllers\User\KinerjaController::class, 'index'])->name('kinerja');
        // Route::get('/kompetensi', [\App\Http\Controllers\User\KompetensiController::class, 'index'])->name('kompetensi');
    });
    // Route::get('/notification', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

});

