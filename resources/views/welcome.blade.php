<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('title', 'Beranda - SI Prakerin')

@section('content')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px -5px rgba(59, 130, 246, 0.5);
    }
    .step-card {
        transition: all 0.3s ease;
    }
    .step-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -5px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container mx-auto px-10 py-4">
    <!-- Hero Section dengan Gradient -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl shadow-xl overflow-hidden mb-8">
        <div class="px-6 py-8 md:py-10 md:px-8 relative">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-bold mb-1">
                    Selamat datang ...
                </h1>
                <p class="text-lg md:text-xl mb-5 max-w-3xl">
                    di Sistem Informasi Prakerin UPT Komputer - UNIPMA
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('prakerin.index') }}"
                        class="bg-white text-blue-700 hover:bg-yellow-400 hover:text-blue-800 px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-200 flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Mulai Pendataan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
        <!-- Card Prakerin -->
        <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-6 border-blue-500 hover:border-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs uppercase font-semibold tracking-wider">Total Pendataan Prakerin</p>
                    <p class="text-4xl font-bold text-gray-800 mt-1">{{ $totalPrakerin ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Data praktik kerja industri</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card Jurnal -->
        <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-6 border-green-500 hover:border-green-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs uppercase font-semibold tracking-wider">Total Jurnal Kegiatan</p>
                    <p class="text-4xl font-bold text-gray-800 mt-1">{{ $totalJurnal ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Jurnal kegiatan harian siswa</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Cara Penggunaan Sistem -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Cara Penggunaan Sistem</h2>

        <p class="text-gray-700 mb-4 text-base">Alur penggunaan sistem untuk siswa Prakerin:</p>

        <div class="space-y-3 mb-6">
            <!-- Step 1 -->
            <div class="step-card flex items-start gap-3 p-4 bg-blue-50 rounded-lg border-l-6 border-blue-500">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-base flex-shrink-0 shadow">1</div>
                <div>
                    <h3 class="font-bold text-base text-blue-800">Isi Form Pendataan Prakerin</h3>
                    <p class="text-gray-700 text-sm mt-0.5">Siswa wajib mengisi form pendataan prakerin terlebih dahulu dengan data lengkap dan benar.</p>
                    <div class="mt-1">
                        <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded-full">WAJIB</span>
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full ml-1">Langkah pertama</span>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-card flex items-start gap-3 p-4 bg-green-50 rounded-lg border-l-6 border-green-500">
                <div class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-base flex-shrink-0 shadow">2</div>
                <div>
                    <h3 class="font-bold text-base text-green-800">Klik Tombol Simpan</h3>
                    <p class="text-gray-700 text-sm mt-0.5">Setelah mengisi data dengan lengkap dan benar, klik tombol <span class="font-semibold bg-green-200 px-1.5 py-0.5 rounded text-xs">Simpan</span>.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-card flex items-start gap-3 p-4 bg-blue-50 rounded-lg border-l-6 border-blue-500">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-base flex-shrink-0 shadow">3</div>
                <div>
                    <h3 class="font-bold text-base text-blue-800">Akses Menu Jurnal</h3>
                    <p class="text-gray-700 text-sm mt-0.5">Setelah data prakerin tersimpan, siswa dapat mengakses menu <span class="font-semibold bg-blue-200 px-1.5 py-0.5 rounded text-xs">Jurnal</span>.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-card flex items-start gap-3 p-4 bg-green-50 rounded-lg border-l-6 border-green-500">
                <div class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-base flex-shrink-0 shadow">4</div>
                <div>
                    <h3 class="font-bold text-base text-green-800">Input Jurnal Kegiatan</h3>
                    <p class="text-gray-700 text-sm mt-0.5">Catat kegiatan harian selama prakerin. Input tanggal, tempat, dan deskripsi kegiatan.</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="step-card flex items-start gap-3 p-4 bg-indigo-50 rounded-lg border-l-6 border-indigo-500">
                <div class="bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-base flex-shrink-0 shadow">5</div>
                <div>
                    <h3 class="font-bold text-base text-indigo-800">Cetak Dokumen</h3>
                    <p class="text-gray-700 text-sm mt-0.5">Setelah semua data lengkap, cetak form pendataan prakerin dan jurnal untuk keperluan administrasi.</p>
                </div>
            </div>
        </div>

        <!-- Info Penting -->
        <div class="mt-5 p-4 bg-red-50 rounded-lg border border-red-200">
            <div class="flex items-start gap-2">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <h4 class="font-bold text-red-800 text-sm">PENTING!</h4>
                    <p class="text-red-700 text-xs">Siswa <span class="font-bold underline">TIDAK DAPAT mengisi jurnal</span> sebelum menyelesaikan form pendataan prakerin.</p>
                </div>
            </div>
        </div>

        <!-- Info Alamat -->
        <div class="mt-5 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <h3 class="font-bold text-base text-gray-800 mb-1">UPT Komputer - UNIPMA</h3>
            <p class="text-gray-700 flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Jalan Setia Budi No. 85 Madiun
            </p>
        </div>
    </div>

    <!-- Fitur Unggulan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100">
            <div class="flex items-start gap-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Manajemen Prakerin</h3>
                    <p class="text-gray-600 text-xs mt-0.5">Kelola data siswa, asal sekolah, jurusan, dan periode prakerin.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4 border border-green-100">
            <div class="flex items-start gap-3">
                <div class="bg-green-600 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Jurnal Kegiatan</h3>
                    <p class="text-gray-600 text-xs mt-0.5">Catat setiap kegiatan harian siswa selama prakerin.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4 border border-yellow-100">
            <div class="flex items-start gap-3">
                <div class="bg-green-600 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Cetak Otomatis</h3>
                    <p class="text-gray-600 text-xs mt-0.5">Cetak formulir dengan tampilan profesional siap tanda tangan.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 border border-purple-100">
            <div class="flex items-start gap-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Database Terintegrasi</h3>
                    <p class="text-gray-600 text-xs mt-0.5">Data tersimpan rapi dan terintegrasi antara prakerin dan jurnal.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer dengan Copyright - Full Width -->
<footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white w-full py-3 mt-6">
    <div class="text-center text-xs text-gray-300">
        Jalan Setia Budi No. 85 Madiun | Telp. (0351) 123456 | Email: upt.komputer@unipma.ac.id
    </div>
    <div class="text-center text-[10px] text-gray-400 mt-2">
        <p>&copy; 2026 SIPrakerin. All rights reserved.</p>
    </div>
</footer>
@endsection