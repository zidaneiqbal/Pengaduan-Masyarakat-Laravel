<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\KategoriController;

Route::post('login', [LoginController::class,'login']);
Route::post('register', [LoginController::class,'register']);

Route::group(['middleware' => ['jwt.verify:admin,petugas,masyarakat']], function () {
    Route::get('login/check', [LoginController::class,'loginCheck']);
    Route::post('logout', [LoginController::class,'logout']);
});

//Admin Level
Route::group(['middleware' => ['jwt.verify:admin']], function () { //untuk hak akses admin dan petugas
    //Masyarakat
  	Route::get('masyarakat', [MasyarakatController::class, 'getAll']); //get all
  	Route::get('masyarakatid/{id_user}', [MasyarakatController::class, 'getById']); //get all
  	Route::get('masyarakat/{limit}/{offset}', [MasyarakatController::class, 'getAll']); //get all dengan limit
    Route::put('masyarakat/{id_user}', [MasyarakatController::class, 'update']); //update
    Route::delete('masyarakat/{id_user}', [MasyarakatController::class, 'delete']); //delete

    //Petugas
  	Route::get('petugas', [PetugasController::class, 'getAll']); //get all
  	Route::get('petugas/{id}', [PetugasController::class, 'getById']); //get all
  	Route::get('petugas/{limit}/{offset}', [PetugasController::class, 'getAll']); //get all dengan limit
    Route::post('petugas', [PetugasController::class, 'insert']); //insert
    Route::put('petugas/{id_petugas}', [PetugasController::class, 'update']); //update
    Route::delete('petugas/{id_petugas}', [PetugasController::class, 'delete']); //delete

    //Kategori
  	Route::get('kategori', [KategoriController::class, 'getAll']); //get all
  	Route::get('kategori/{id_kategori}', [KategoriController::class, 'getById']); //get all
  	Route::get('kategori/{limit}/{offset}', [KategoriController::class, 'getAll']); //get all dengan limit
    Route::post('kategori', [KategoriController::class, 'insert']); //insert
    Route::put('kategori/{id_kategori}', [KategoriController::class, 'update']); //update
    Route::delete('kategori/{id_kategori}', [KategoriController::class, 'delete']); //delete

    //Report
    Route::post('pengaduan/report', [PengaduanController::class, 'report']);

});

Route::group(['middleware' => ['jwt.verify:admin,petugas']], function () {
    //Pengaduan Petugas
	Route::get('pengaduan', [PengaduanController::class, 'getAllPengaduan']); //get all
	Route::get('pengaduan/{id_pengaduan}', [PengaduanController::class, 'getById']); //get all
	Route::get('pengaduan/{limit}/{offset}', [PengaduanController::class, 'getAllPengaduan']); //get all by limit
	Route::post('pengaduan/status', [PengaduanController::class, 'changeStatus']); //ubah status pengaduan
	Route::post('pengaduan/tanggapan', [TanggapanController::class, 'send']); //memasukan tanggapan


});

//Masyarakat Level
Route::group(['middleware' => ['jwt.verify:masyarakat']], function () { //untuk hak akses masyarakat
    //Pengaduan Masyarakat
	Route::get('masyarakat/pengaduan', [PengaduanController::class, 'getAllPengaduan']); //get all
	Route::get('masyarakat/pengaduan/{limit}/{offset}', [PengaduanController::class, 'getAllPengaduan']); //get all
	Route::post('masyarakat/pengaduan', [PengaduanController::class, 'insert']); //insert
  Route::get('masyarakat/kategorii', [KategoriController::class, 'getAll']); //getKategori

});
