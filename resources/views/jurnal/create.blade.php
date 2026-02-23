@extends('layouts.app')

@section('title', 'Jurnal Prakerin')

@section('content')

<!-- Main Content -->
<div class="container mx-auto px-10 py-4">
    <!-- Breadcrumb -->
    <div class="mb-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-xs font-medium text-gray-600 hover:text-[#3b5b8c] transition">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1 text-xs"></i>
                        <span class="text-xs font-medium text-[#3b5b8c]">Input Jurnal</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-xl shadow-lg p-5 mb-4 text-white">
        <h1 class="text-2xl font-bold mb-1">
            Input Jurnal Prakerin
        </h1>
        <p class="text-white/80 text-sm">Silakan isi jurnal kegiatan harian prakerin dengan lengkap dan benar</p>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg shadow-md mb-4 flex items-start">
        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-0.5"></i>
        <div>
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4 flex items-start">
        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
        <div>
            <p class="font-semibold">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-100">
        <form action="{{ route('jurnal.store') }}" method="POST" class="space-y-4" id="jurnalForm">
            @csrf

            <!-- No Jurnal & Waktu Input-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- No Jurnal -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 rounded-lg border border-blue-100">
                    <label class="block text-xs font-semibold text-gray-800 mb-1">
                        <i class="fas fa-hashtag mr-1 text-[#3b5b8c] text-xs"></i>No Jurnal (Preview)
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-[#3b5b8c] font-bold text-sm">#</span>
                            </div>
                            <input
                                type="text"
                                value="{{ $noJurnalPreview }}"
                                readonly
                                class="w-full bg-gray-100 border border-[#3b5b8c]/20 text-gray-800 text-sm font-bold rounded-lg pl-7 p-2.5 cursor-not-allowed shadow-inner">
                        </div>
                        <span class="text-xs text-gray-600 bg-white px-2 py-1 rounded-full border border-gray-200 whitespace-nowrap">
                            <i class="fas fa-info-circle mr-1 text-[#3b5b8c] text-xs"></i>
                            Otomatis
                        </span>
                    </div>
                </div>

                <!-- Waktu Input -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-3 rounded-lg border border-gray-200">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-clock mr-1 text-[#3b5b8c] text-xs"></i>Waktu Input
                    </label>
                    <input
                        type="text"
                        id="realtimeClock"
                        readonly
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg p-2.5 cursor-not-allowed">
                </div>
            </div>

            <!-- Hidden input untuk no_jurnal -->
            <input type="hidden" name="no_jurnal" value="{{ $noJurnalPreview }}">

            <!-- NIS dengan tombol cek -->
            <div>
                <label for="nis" class="block text-xs font-semibold text-gray-700 mb-1">
                    <i class="fas fa-id-card mr-1 text-[#3b5b8c] text-xs"></i>NIS
                </label>
                <div class="flex gap-2">
                    <div class="flex-grow">
                        <input
                            type="text"
                            id="nis"
                            name="nis"
                            value="{{ old('nis') }}"
                            maxlength="12"
                            inputmode="numeric"
                            placeholder="Masukkan NIS"
                            class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                            required>
                    </div>
                    <button type="button" id="cekNisBtn"
                        class="bg-[#3b5b8c] hover:bg-[#2a4a7a] text-white text-sm font-medium px-4 py-2 rounded-lg transition-all flex items-center gap-1">
                        <i class="fas fa-search text-xs"></i>
                        Cek
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1 text-gray-400"></i>
                    Masukkan NIS dan klik Cek untuk melihat data siswa
                </p>
                <div id="nisLoading" class="hidden text-xs text-blue-600 mt-2">
                    <i class="fas fa-spinner fa-spin mr-1"></i>Mencari data...
                </div>
                <div id="nisError" class="hidden text-red-500 text-xs mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    <span id="nisErrorMessage"></span>
                </div>
            </div>

            <!-- Data Siswa Card (Muncul setelah NIS ditemukan) -->
            <div id="dataSiswaCard" class="hidden bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user-graduate mr-2 text-[#3b5b8c]"></i>
                    Data Siswa
                </h3>

                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-xs text-gray-500">Nama Siswa</p>
                        <p id="displayNama" class="font-medium text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Asal Sekolah</p>
                        <p id="displaySekolah" class="font-medium text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Jurusan</p>
                        <p id="displayJurusan" class="font-medium text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Periode Prakerin</p>
                        <p id="displayPeriode" class="font-medium text-gray-800">-</p>
                    </div>
                </div>

                <div class="mt-3 text-xs text-green-600 bg-green-50 p-2 rounded">
                    <i class="fas fa-check-circle mr-1"></i>
                    Data siswa ditemukan! Silakan lanjutkan mengisi jurnal.
                </div>
            </div>

            <!-- Grid 2 Kolom untuk Tempat dan Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Tempat -->
                <div>
                    <label for="tempat" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-[#3b5b8c] text-xs"></i>Tempat
                    </label>
                    <input
                        type="text"
                        id="tempat"
                        name="tempat"
                        value="{{ old('tempat') }}"
                        placeholder="Lokasi kegiatan"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                        required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-calendar-alt mr-1 text-[#3b5b8c] text-xs"></i>Tanggal Kegiatan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <i class="fas fa-calendar-day text-gray-400 text-xs"></i>
                        </div>
                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal') }}"
                            class="w-full border border-gray-200 rounded-lg p-2.5 pl-8 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                            required>
                    </div>
                </div>
            </div>

            <!-- Kegiatan -->
            <div>
                <label for="kegiatan" class="block text-xs font-semibold text-gray-700 mb-1">
                    <i class="fas fa-tasks mr-1 text-[#3b5b8c] text-xs"></i>Kegiatan
                </label>
                <textarea
                    id="kegiatan"
                    name="kegiatan"
                    rows="3"
                    placeholder="Tuliskan kegiatan yang dilakukan"
                    class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                    required>{{ old('kegiatan') }}</textarea>
            </div>

            <!-- Form Actions -->
            <div class="pt-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
                    <div class="text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
                        <i class="fas fa-exclamation-circle mr-1 text-[#3b5b8c]"></i>
                        Pastikan data jurnal sudah benar
                    </div>

                    <div class="flex space-x-2">
                        <button type="reset"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm py-2 px-4 rounded-lg transition-all border border-gray-200 flex items-center">
                            <i class="fas fa-undo mr-1 text-xs"></i>Reset
                        </button>
                        <button type="submit" id="submitBtn"
                            class="bg-gradient-to-r from-[#3b5b8c] to-[#4a6b9e] hover:from-[#2a4a7a] hover:to-[#3b5b8c] text-white font-medium text-sm py-2 px-5 rounded-lg transition-all transform hover:scale-105 shadow flex items-center">
                            <i class="fas fa-save mr-1 text-xs"></i>Simpan Jurnal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // NIS hanya angka
    document.getElementById('nis')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);
    });

    // Cek NIS via AJAX
    document.getElementById('cekNisBtn')?.addEventListener('click', function() {
        const nis = document.getElementById('nis').value;

        if (!nis) {
            alert('Masukkan NIS terlebih dahulu');
            return;
        }

        // Tampilkan loading
        document.getElementById('nisLoading').classList.remove('hidden');
        document.getElementById('nisError').classList.add('hidden');
        document.getElementById('dataSiswaCard').classList.add('hidden');

        console.log('Mencari NIS:', nis);

        // Fetch data - PASTIKAN URL INI SESUAI
        fetch(`/get-siswa-by-nis/${nis}`)
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                document.getElementById('nisLoading').classList.add('hidden');

                if (data.status === 'success') {
                    // Tampilkan data siswa
                    document.getElementById('displayNama').textContent = data.data.nama_siswa;
                    document.getElementById('displaySekolah').textContent = data.data.sekolah;
                    document.getElementById('displayJurusan').textContent = data.data.jurusan;
                    document.getElementById('displayPeriode').textContent =
                        `${data.data.tanggal_mulai} s/d ${data.data.tanggal_akhir}`;

                    document.getElementById('dataSiswaCard').classList.remove('hidden');
                } else {
                    // Tampilkan error
                    document.getElementById('nisErrorMessage').textContent = data.message;
                    document.getElementById('nisError').classList.remove('hidden');
                }
            })
            .catch(error => {
                document.getElementById('nisLoading').classList.add('hidden');
                document.getElementById('nisErrorMessage').textContent = 'Terjadi kesalahan: ' + error.message;
                document.getElementById('nisError').classList.remove('hidden');
                console.error('Error:', error);
            });
    });

    // Cek otomatis saat NIS diisi (opsional)
    document.getElementById('nis')?.addEventListener('blur', function() {
        if (this.value.length >= 8) {
            document.getElementById('cekNisBtn').click();
        }
    });

    // Loading state saat submit
    document.getElementById('jurnalForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1 text-xs"></i>Menyimpan...';
            btn.disabled = true;
        }
    });

    // Real-time clock
    function updateClock() {
        const now = new Date();
        const formatted =
            now.getDate().toString().padStart(2, '0') + '-' +
            (now.getMonth() + 1).toString().padStart(2, '0') + '-' +
            now.getFullYear() + ' ' +
            now.getHours().toString().padStart(2, '0') + ':' +
            now.getMinutes().toString().padStart(2, '0') + ':' +
            now.getSeconds().toString().padStart(2, '0');

        const clockElement = document.getElementById('realtimeClock');
        if (clockElement) {
            clockElement.value = formatted;
        }
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection