<?php

namespace App;

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\MobilitasController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\MedicalCheckController;
use App\Http\Controllers\AsuhanKeperawatanController;


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

Route::get('/', function () {
  return view('auth.login');
})->name('login.get');
Route::group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Auth'], function () {
  Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
  Route::get('/login/error/{id}/{urls}', [AuthController::class, 'error'])->name('login.error');
  Route::get('/login/error/login', [AuthController::class, 'errorLogin'])->name('login.error2');
  Route::get('/login/error/0', [AuthController::class, 'errorLogin'])->name('login.error3');
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// home
Route::get('home', function () {
  return view('home.index', $data = ['routes_name' => ['']]);
});


Route::group(['prefix' => 'accounts', 'as' => 'accounts.', 'middleware' => ['role:admin,manajer']], function () {
  Route::get('/', [AccountsController::class, 'index'])->name('index');
});
//admin
Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.', 'middleware' => ['role:admin,manajer']], function () {
  // Route::get('kepegawaian/', [AdminController::class, 'kepegawaian'])->name('kepegawaian');
  // Route::get('kepegawaian/redirect', [AdminController::class, 'kepegawaianredirect'])->name('kepegawaian.redirect');
  // Route::get('kepegawaian/success', [AdminController::class, 'success'])->name('kepegawaian.success');
  // Route::get('/pegawai/tambah', [AdminController::class, 'tambahPegawai'])->name('pegawai.tambah');
  // Route::post('/pegawai/tambah/proses', [AdminController::class, 'prosesTambahPegawai'])->name('pegawai.prosestambah');
  // Route::get('/pegawai/ubahpassword', [AdminController::class, 'ubahpassword'])->name('pegawai.ubahpassword');
  // Route::post('/pegawai/ubahpassword/proses', [AdminController::class, 'prosesUbahPassword'])->name('pegawai.prosesubahpassword');
  // Route::post('/pegawai/edit/get', [AdminController::class, 'getEdit'])->name('pegawai.edit.get');
  // Route::post('/pegawai/detail', [AdminController::class, 'detail'])->name('pegawai.detail');
  // Route::post('/pegawai/edit/proses', [AdminController::class, 'prosesEdit'])->name('pegawai.prosesedit');

  Route::get('/', [PegawaiController::class, 'kepegawaian'])->name('index');
  Route::post('/edit/get', [PegawaiController::class, 'getEdit'])->name('edit.get');
  Route::post('/detail', [PegawaiController::class, 'detail'])->name('detail');
  Route::post('/tambah/proses', [PegawaiController::class, 'prosesTambahPegawai'])->name('prosestambah');
  Route::get('/tambah', [PegawaiController::class, 'tambahPegawai'])->name('tambah');
  Route::get('/ubahpassword/{id}', [PegawaiController::class, 'ubahpassword'])->name('ubahpassword');
  Route::post('/ubahpassword/proses', [PegawaiController::class, 'prosesUbahPassword'])->name('prosesubahpassword');
  Route::get('/ubahpegawai/{id}', [PegawaiController::class, 'ubahPegawai'])->name('ubah');
  Route::post('/ubahpegawai/proses', [PegawaiController::class, 'prosesUbahPegawai'])->name('prosesubah');
});

Route::group(['prefix' => 'penghuni', 'as' => 'penghuni.', 'middleware' => ['role:admin,manajer,perawat']], function () {
  Route::get('/', [PenghuniController::class, 'penghuni'])->name('index');
  Route::post('/tambah/proses', [PenghuniController::class, 'prosesTambahPenghuni'])->name('prosestambah');
  Route::get('/tambah', [PenghuniController::class, 'tambahPenghuni'])->name('tambah');
  Route::post('/detail', [PenghuniController::class, 'detailPenghuni'])->name('detail');
  Route::post('/edit/get', [PenghuniController::class, 'getEditPenghuni'])->name('edit.get');
  Route::post('/ubah/proses', [PenghuniController::class, 'prosesUbahPenghuni'])->name('prosesubah');
  Route::get('/ubah/{id}', [PenghuniController::class, 'ubahPenghuni'])->name('ubah');
  Route::post('/data', [PenghuniController::class, 'data_penghuni'])->name('data');
});

Route::group(['prefix' => 'askep', 'as' => 'askep.', 'middleware' => ['role:admin,manajer,perawat']], function () {
  Route::get('/', [AsuhanKeperawatanController::class, 'penghuni'])->name('index');
  Route::post('/data', [AsuhanKeperawatanController::class, 'data_penghuni'])->name('data');
  Route::get('/detail_askep/{id_diagnosa_penghuni}', [AsuhanKeperawatanController::class, 'detail_askep_penghuni'])->name('detail_askep');
  Route::get('/tambah', [AsuhanKeperawatanController::class, 'tambah_askep'])->name('tambah');
  Route::get('/delete/{id_diagnosa_penghuni}', [AsuhanKeperawatanController::class, 'delete'])->name('delete');
  Route::get('/edit/{id_diagnosa_penghuni}/{index?}', [AsuhanKeperawatanController::class, 'edit'])->name('edit');
  Route::post('/form_askep', [AsuhanKeperawatanController::class, 'form_askep'])->name('form_askep');
  Route::post('/proses_edit', [AsuhanKeperawatanController::class, 'proses_edit_askep'])->name('proses_edit');
  Route::post('/proses_tambah', [AsuhanKeperawatanController::class, 'proses_tambah_askep'])->name('proses_tambah');
  Route::get('/detail/{id_askep}', [AsuhanKeperawatanController::class, 'detail_askep'])->name('detail');
  Route::post('/data_askep_penghuni', [AsuhanKeperawatanController::class, 'data_askep_penghuni'])->name('data_askep_penghuni');
});

Route::group(['prefix' => 'rekmed', 'as' => 'rekmed.', 'middleware' => ['role:admin,manajer,perawat,assisten']], function () {

  Route::get('/', [RekamMedisController::class, 'penghuni'])->name('index');
  Route::post('/data', [RekamMedisController::class, 'data_penghuni'])->name('data');
  Route::get('/detail/{id}', [RekamMedisController::class, 'detailMedis'])->name('detail');

  Route::get('detail_medis_data/{id}/{data}', [RekamMedisController::class, 'detail_medis_data'])->name('data_details');
  Route::post('detail_medis_table/{data}', [RekamMedisController::class, 'detail_medis_table'])->name('data_details_table');
  Route::get('detail_medis_chart/{id}/{data}/{from_date}/{until_date}', [RekamMedisController::class, 'detail_medis_chart'])->name('detail_medis_chart');

  // Route::get('hapus_mcu/{id}/{data}/{id_penghuni}', [UserController::class, 'hapus_mcu'])->name('hapus')->middleware('role:admin,perawat,assisten');
  Route::post('hapus_mcu', [RekamMedisController::class, 'hapus_mcu'])->name('hapus')->middleware('role:admin,perawat,assisten');
  Route::get('/tambah/{bagian}/{id}', [RekamMedisController::class, 'tambah_mcu'])->name('tambah')->middleware('role:admin,perawat,assisten');
  Route::post('simpan_mcu', [RekamMedisController::class, 'simpan_mcu'])->name('simpan')->middleware('role:admin,perawat,assisten');
});

Route::group(['prefix' => 'mobilitas', 'as' => 'mobilitas.', 'middleware' => ['role:admin,manajer,perawat,assisten']], function () {
  Route::get('/', [MobilitasController::class, 'mobilitas'])->name('index');
  Route::post('/data', [MobilitasController::class, 'dataMobilitas'])->name('data');
  Route::post('/detail', [MobilitasController::class, 'detailMobilitas'])->name('detail');
  Route::get('/tambah', [MobilitasController::class, 'tambahMobilitas'])->name('tambah')->middleware('role:admin,perawat,assisten');
  Route::post('/proses_tambah', [MobilitasController::class, 'prosesTambahMobilitas'])->name('prosestambah')->middleware('role:admin,perawat,assisten');
  Route::get('/edit/{id}', [MobilitasController::class, 'editMobilitas'])->name('edit')->middleware('role:admin,perawat,assisten');
  Route::post('/proses_edit', [MobilitasController::class, 'prosesEditMobilitas'])->name('prosesedit')->middleware('role:admin,perawat,assisten');
  Route::get('/pulang/{id}', [MobilitasController::class, 'pulangMobilitas'])->name('pulang')->middleware('role:admin,perawat,assisten');
  Route::post('/tambah_pulang', [MobilitasController::class, 'tambahPulangMobilitas'])->name('tambah_pulang')->middleware('role:admin,perawat,assisten');

  // Route::get('/', [MobilitasController::class, 'data_mobilitas_keluar'])->name('data_keluar');
});

Route::group(['prefix' => 'farmasi', 'as' => 'farmasi.', 'middleware' => ['role:admin,manajer,farmasi']], function () {
  Route::get('/', [FarmasiController::class, 'index'])->name('index');
  Route::post('/data', [FarmasiController::class, 'data'])->name('data');
  Route::get('/tambah', [FarmasiController::class, 'tambah_obat'])->name('tambah_obat')->middleware('role:admin,farmasi');
  Route::post('/hapus', [FarmasiController::class, 'hapus_obat'])->name('hapus_obat')->middleware('role:admin,farmasi');
  Route::post('/konfirm_hapus', [FarmasiController::class, 'konfirmasi_hapus_obat'])->name('konfirmasi_hapus_obat')->middleware('role:admin,farmasi');
  Route::post('/proses_hapus', [FarmasiController::class, 'proses_hapus_obat'])->name('proses_hapus_obat')->middleware('role:admin,farmasi');
  Route::post('/proses_hapus_transaksi', [FarmasiController::class, 'proses_hapus_transaksi'])->name('proses_hapus_transaksi')->middleware('role:admin,farmasi');
  Route::post('/proses_tambah_obat', [FarmasiController::class, 'proses_tambah_obat'])->name('proses_tambah_obat')->middleware('role:admin,farmasi');
  Route::post('/proses_tambah_transaksi', [FarmasiController::class, 'proses_tambah_transaksi'])->name('proses_tambah_transaksi')->middleware('role:admin,farmasi');
  Route::get('/transaksi/{id_obat}', [FarmasiController::class, 'transaksi'])->name('transaksi');
  Route::get('/tambah_transaksi/{id_obat?}', [FarmasiController::class, 'tambah_transaksi'])->name('tambah_transaksi')->middleware('role:admin,farmasi');
  Route::post('/proses_edit_obat', [FarmasiController::class, 'proses_edit_obat'])->name('proses_edit_obat')->middleware('role:admin,farmasi');
  Route::post('/proses_edit_transaksi', [FarmasiController::class, 'proses_edit_transaksi'])->name('proses_edit_transaksi')->middleware('role:admin,farmasi');
  Route::get('/edit_obat/{id_obat}', [FarmasiController::class, 'edit_obat'])->name('edit_obat')->middleware('role:admin,farmasi');
  Route::get('/edit_transaksi/{id_history}', [FarmasiController::class, 'edit_transaksi'])->name('edit_transaksi')->middleware('role:admin,farmasi');
  Route::get('/pindah_kepemilikan/{id_obat}', [FarmasiController::class, 'pindah_kepemilikan'])->name('pindah_kepemilikan')->middleware('role:admin,farmasi');
  Route::post('/proses_pindah_kepemilikan', [FarmasiController::class, 'proses_pindah_kepemilikan'])->name('proses_pindah_kepemilikan')->middleware('role:admin,farmasi');
  Route::post('/transaksi_data', [FarmasiController::class, 'transaksi_data'])->name('transaksi_data');

  // Route::get('/', [MobilitasController::class, 'data_mobilitas_keluar'])->name('data_keluar');
});





// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
//     Route::get('penghuni/', [PenghuniController::class, 'penghuni'])->name('penghuni');
//     Route::post('/penghuni/tambah/proses', [PenghuniController::class, 'prosesTambahPenghuni'])->name('penghuni.prosestambah');
//     Route::get('/penghuni/tambah/', [PenghuniController::class, 'tambahPenghuni'])->name('penghuni.tambah');
//     Route::post('/penghuni/detail', [PenghuniController::class, 'detailPenghuni'])->name('penghuni.detail');
//     Route::post('/penghuni/edit/get', [PenghuniController::class, 'getEditPenghuni'])->name('penghuni.edit.get');
//     Route::post('/penghuni/ubahpenghuni/proses', [PenghuniController::class, 'getEditPenghuni'])->name('penghuni.prosesubah');
//     Route::get('/penghuni/ubahpenghuni', [PenghuniController::class, 'ubahPenghuni'])->name('penghuni.ubah');
// });

//User
// Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User'], function () {
//     Route::get('rekammedis', [UserController::class, 'rekamMedis'])->name('rekammedis');
//     Route::get('rekammedis/fetch_data/', [UserController::class, 'fetch_data'])->name('rekammedis.fetch_data');
//     Route::get('detail_medis/{id}', [UserController::class, 'detail_medis'])->name('detail_medis');
//     Route::get('detail_medis_data/{id}/{data}', [UserController::class, 'detail_medis_data'])->name('detail_medis_data');
//     Route::get('detail_medis_table/{id}/{data}', [UserController::class, 'detail_medis_table'])->name('detail_medis_table');
//     Route::get('detail_medis_chart/{id}/{data}/{from_date}/{until_date}', [UserController::class, 'detail_medis_chart'])->name('detail_medis_chart');
//     Route::get('tambah_mcu/{id}', [UserController::class, 'tambah_mcu'])->name('mcu.tambah');
//     Route::post('simpan_mcu', [UserController::class, 'simpan_mcu'])->name('mcu.simpan');
//     Route::get('hapus_mcu/{id}/{data}/{id_penghuni}', [UserController::class, 'hapus_mcu'])->name('mcu.hapus');
//     Route::post('mcu/hasil_rekam', [UserController::class, 'hasil_rekam'])->name('mcu.hasil_rekam');
//     Route::get('penghuni/', [UserController::class, 'penghuni'])->name('penghuni');
//     Route::post('/penghuni/tambah/proses', [UserController::class, 'prosesTambahPenghuni'])->name('penghuni.prosestambah');
//     Route::get('/penghuni/tambah/', [UserController::class, 'tambahPenghuni'])->name('penghuni.tambah');
//     Route::post('/penghuni/detail', [UserController::class, 'detailPenghuni'])->name('penghuni.detail');
//     Route::post('/penghuni/edit/get', [UserController::class, 'getEditPenghuni'])->name('penghuni.edit.get');
// });

// Inventory Obat
// Route::get('/daftar_obat', [ObatController::class, 'index']);
// Route::get('/daftar_obat/fetch_data/', [ObatController::class, 'fetch_data'])->name('daftarobat.fetch_data');

// Route::get('/detail_obat/{id}', [ObatController::class, 'detail']);
// Route::get('/detail_obat/{id}/detail_data', [ObatController::class, 'detail_data']);

// Route::get('/transaksi_obat', [ObatController::class, 'transaksi']);
// Route::get('/transaksi_obat/fetch_data', [ObatController::class, 'transaksi_data']);
// Route::get('/edit_transaksi/{id}/{trans}', [ObatController::class, 'edit_transaksi']);
// Route::get('/delete_transaksi/konfirmasi/{id}', [ObatController::class, 'konfirmasi_delete_transaksi']);
// Route::post('/delete_transaksi', [ObatController::class, 'delete_stok']);

// Route::get('/hapus_obat/{id}', [ObatController::class, 'deleteConfirm']);
// Route::post('/delete_obat', [ObatController::class, 'delete_obat']);

// Route::get('/tambah_obat/{form}/{nama}', [ObatController::class, 'tambah_obat']);
// Route::post('/simpan_obat', [ObatController::class, 'simpan_obat']);

// Route::get('/edit_stok/{id}/{trans}', [ObatController::class, 'edit_stok']);
// Route::get('/tambah_stok/{id}', [ObatController::class, 'tambah_stok']);
// Route::get('/kurang_stok/{id}', [ObatController::class, 'kurang_stok']);
// Route::get('/delete_stok/konfirmasi/{id}', [ObatController::class, 'konfirmasi_delete_stok']);
// Route::post('/delete_stok', [ObatController::class, 'delete_stok']);
// Route::post('/simpan_stok', [ObatController::class, 'simpan_stok']);
