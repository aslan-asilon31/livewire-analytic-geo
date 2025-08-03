<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

// Route::get('/', Welcome::class);

// Route::get('/', \App\Livewire\PendapatanPerWilayah::class)->name('pendapatan.perwilayah');
Route::get('/', \App\Livewire\Welcome::class)->name('welcome');
Route::get('/penjualan-by-waktu', \App\Livewire\PenjualanByWaktu::class)->name('penjualan.bywaktu');
Route::get('/detail-cabang/{cabang}', \App\Livewire\DetailCabang::class)->name('detail.cabang');
Route::get('/jumlah-transaki-per-wilayah', \App\Livewire\JumlahTransaksiPerWilayah::class)->name('transaksi');

