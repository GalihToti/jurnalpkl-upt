@extends('layouts.app')

@section('title', 'Pendataan Prakerin')

@section('content')

<!-- Main Content -->
<div class="container mx-auto px-10 py-4">
    <!-- Breadcrumb -->
    <div class="mb-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-xs font-medium text-gray-600 hover:text-[#3b5b8c] transition">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1 text-xs"></i>
                        <span class=" text-xs font-medium text-[#3b5b8c]">Pendataan Prakerin</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-xl shadow-lg p-5 mb-4 text-white">
        <h1 class="text-2xl font-bold mb-1">Pendataan Prakerin</h1>
        <p class="text-white/80 text-sm">Silakan isi formulir berikut dengan data yang lengkap dan benar</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg shadow-md mb-4 flex items-start">
        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-0.5"></i>
        <div>
            <p class="font-semibold">{{ session('success') }}</p>
            <p class="text-green-700 text-sm mt-1">
                Nomor Pendaftaran Anda:
                <span class="font-bold text-lg block mt-0.5 text-green-600">
                    {{ session('no_pendataan') }}
                </span>
            </p>
        </div>
    </div>
    @endif

    <!-- Notifikasi NIS sudah terdaftar -->
    @if(session('nis_error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4 flex items-start">
        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
        <div>
            <p class="font-semibold">{{ session('nis_error') }}</p>
            <p class="text-red-700 text-sm mt-1">
                NIS <span class="font-bold">{{ session('nis_duplicate') }}</span> sudah terdaftar atas nama
                <span class="font-bold">{{ session('nama_duplicate') }}</span>
            </p>
            <p class="text-red-600 text-xs mt-2">
                <i class="fas fa-info-circle mr-1"></i>
                Gunakan NIS lain atau hubungi admin jika ini adalah data Anda
            </p>
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-100">
        <form action="{{ route('prakerin.store') }}" method="POST" class="space-y-4" id="prakerinForm">
            @csrf

            <!-- No Pendataan (Preview) -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 rounded-lg border border-blue-100">
                <label class="block text-sm font-semibold text-gray-800 mb-1">
                    <i class="fas fa-hashtag mr-1 text-[#3b5b8c] text-xs"></i>Nomor Pendaftaran (Preview)
                </label>
                <div class="flex items-center flex-wrap gap-2">
                    <div class="relative flex-grow max-w-xs">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-[#3b5b8c] font-bold text-sm">#</span>
                        </div>
                        <input
                            type="text"
                            value="{{ $noPendataanPreview }}"
                            readonly
                            class="w-full bg-gray-100 border border-gray-300 text-gray-700 text-base font-medium rounded-lg pl-6 p-2.5 cursor-not-allowed">
                    </div>
                    <span class="text-xs text-gray-600 bg-white px-3 py-1.5 rounded-full border border-gray-200">
                        <i class="fas fa-info-circle mr-1 text-[#3b5b8c] text-xs"></i>
                        Otomatis
                    </span>
                </div>
            </div>

            <!-- Grid 2 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- NIS -->
                <div>
                    <label for="nis" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-id-card mr-1 text-[#3b5b8c] text-xs"></i>NIS
                    </label>
                    <input
                        type="text"
                        id="nis"
                        name="nis"
                        maxlength="12"
                        inputmode="numeric"
                        placeholder="Masukkan NIS"
                        value="{{ old('nis') }}"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all {{ session('nis_error') ? 'border-red-300 bg-red-50' : '' }}"
                        required>
                    <p class="text-xs text-gray-500 mt-1">8-12 digit angka</p>
                </div>

                <!-- Nama Siswa -->
                <div>
                    <label for="nama_siswa" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-user mr-1 text-[#3b5b8c] text-xs"></i>Nama Siswa
                    </label>
                    <input
                        type="text"
                        id="nama_siswa"
                        name="nama_siswa"
                        placeholder="Nama lengkap"
                        value="{{ old('nama_siswa') }}"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                        required>
                </div>
            </div>

            <!-- Asal Sekolah -->
            <div>
                <label for="id_sekolah" class="block text-xs font-semibold text-gray-700 mb-1">
                    <i class="fas fa-school mr-1 text-[#3b5b8c] text-xs"></i>Asal Sekolah
                </label>
                <select
                    name="id_sekolah" id="id_sekolah"
                    class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all bg-white"
                    required>
                    <option value="" disabled selected>Pilih asal sekolah</option>
                    @foreach ($sekolah as $id_sekolah)
                    <option value="{{ $id_sekolah->id_sekolah }}" {{ old('id_sekolah') == $id_sekolah->id_sekolah ? 'selected' : '' }}>
                        {{ $id_sekolah->nama_sekolah }}
                    </option>
                    @endforeach
                    <option value="lainnya" class="text-[#3b5b8c] font-medium">➕ Sekolah Lainnya</option>
                </select>

                <div id="sekolahLainContainer" class="hidden mt-2 p-3 bg-gray-50 rounded-lg border border-dashed border-[#3b5b8c]/30">
                    <label for="sekolah_lain" class="block text-gray-700 font-medium text-xs mb-1">
                        <i class="fas fa-plus-circle mr-1 text-[#3b5b8c]"></i>Nama Sekolah Lainnya
                    </label>
                    <input
                        type="text"
                        id="sekolah_lain"
                        name="sekolah_lain"
                        value="{{ old('sekolah_lain') }}"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                        placeholder="Masukkan nama sekolah">
                </div>
            </div>

            <!-- Jurusan -->
            <div>
                <label for="id_jurusan" class="block text-xs font-semibold text-gray-700 mb-1">
                    <i class="fas fa-graduation-cap mr-1 text-[#3b5b8c] text-xs"></i>Jurusan
                </label>
                <select
                    id="id_jurusan"
                    name="id_jurusan"
                    class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all bg-white"
                    required>
                    <option value="" disabled selected>Pilih jurusan</option>
                    @foreach ($jurusan as $id_jurusan)
                    <option value="{{ $id_jurusan->id_jurusan }}" {{ old('id_jurusan') == $id_jurusan->id_jurusan ? 'selected' : '' }}>
                        {{ $id_jurusan->nama_jurusan }}
                    </option>
                    @endforeach
                    <option value="lainnya" class="text-[#3b5b8c] font-medium">➕ Jurusan Lainnya</option>
                </select>

                <div id="jurusanLainContainer" class="hidden mt-2 p-3 bg-gray-50 rounded-lg border border-dashed border-[#3b5b8c]/30">
                    <label class="block text-gray-700 font-medium text-xs mb-1">
                        <i class="fas fa-plus-circle mr-1 text-[#3b5b8c]"></i>Nama Jurusan Lainnya
                    </label>
                    <input
                        type="text"
                        name="jurusan_lain"
                        value="{{ old('jurusan_lain') }}"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                        placeholder="Masukkan nama jurusan lainnya">
                </div>
            </div>

            <!-- Grid Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Tanggal Mulai -->
                <div>
                    <label for="tanggal_mulai_prakerin" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-calendar-alt mr-1 text-[#3b5b8c] text-xs"></i>Tanggal Mulai
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <i class="fas fa-calendar-day text-gray-400 text-xs"></i>
                        </div>
                        <input
                            type="date"
                            id="tanggal_mulai_prakerin"
                            name="tanggal_mulai_prakerin"
                            value="{{ old('tanggal_mulai_prakerin') }}"
                            class="w-full border border-gray-200 rounded-lg p-2.5 pl-8 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                            required>
                    </div>
                </div>

                <!-- Tanggal Akhir -->
                <div>
                    <label for="tanggal_akhir_prakerin" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-calendar-times mr-1 text-[#3b5b8c] text-xs"></i>Tanggal Akhir
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <i class="fas fa-calendar-week text-gray-400 text-xs"></i>
                        </div>
                        <input
                            type="date"
                            id="tanggal_akhir_prakerin"
                            name="tanggal_akhir_prakerin"
                            value="{{ old('tanggal_akhir_prakerin') }}"
                            class="w-full border border-gray-200 rounded-lg p-2.5 pl-8 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                            required>
                    </div>
                </div>
            </div>

            <!-- CAPTCHA -->
            <div class="mt-2 p-3 bg-gray-50 rounded-lg border border-gray-100">
                <label class="block text-xs font-semibold text-gray-700 mb-2">
                    <i class="fas fa-shield-alt mr-1 text-[#3b5b8c]"></i>Verifikasi Keamanan
                </label>
                <div class="g-recaptcha scale-90 origin-left"
                    data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                </div>
                @error('g-recaptcha-response')
                <p class="text-red-600 text-xs mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="pt-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
                    <div class="text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
                        <i class="fas fa-exclamation-circle mr-1 text-[#3b5b8c]"></i>
                        Pastikan data sudah benar
                    </div>

                    <div class="flex space-x-2">
                        <button type="reset"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm py-2 px-4 rounded-lg transition-all border border-gray-200 flex items-center">
                            <i class="fas fa-undo mr-1 text-xs"></i>Reset
                        </button>
                        <button type="submit" id="submitBtn"
                            class="bg-gradient-to-r from-[#3b5b8c] to-[#4a6b9e] hover:from-[#2a4a7a] hover:to-[#3b5b8c] text-white font-medium text-sm py-2 px-5 rounded-lg transition-all transform hover:scale-105 shadow flex items-center">
                            <i class="fas fa-save mr-1 text-xs"></i>Simpan
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
    // Sekolah Lainnya
    document.querySelector('select[name="id_sekolah"]')?.addEventListener('change', function() {
        const container = document.getElementById('sekolahLainContainer');
        if (container) container.classList.toggle('hidden', this.value !== 'lainnya');
    });

    // Jurusan Lainnya
    document.addEventListener('DOMContentLoaded', function() {
        const jurusanSelect = document.getElementById('id_jurusan');
        const jurusanLain = document.getElementById('jurusanLainContainer');

        if (jurusanSelect && jurusanLain) {
            jurusanSelect.addEventListener('change', function() {
                jurusanLain.classList.toggle('hidden', this.value !== 'lainnya');
            });
        }
    });

    // Validasi NIS hanya angka
    document.getElementById('nis')?.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);
    });

    // Validasi tanggal akhir
    document.getElementById('tanggal_mulai_prakerin')?.addEventListener('change', function() {
        const tanggalAkhir = document.getElementById('tanggal_akhir_prakerin');
        if (tanggalAkhir) {
            tanggalAkhir.min = this.value;
            if (tanggalAkhir.value && tanggalAkhir.value < this.value) {
                tanggalAkhir.value = this.value;
            }
        }
    });

    // Loading state saat submit
    document.getElementById('prakerinForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            // Simpan teks asli
            const originalText = btn.innerHTML;

            // Ubah ke loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1 text-xs"></i>Menyimpan...';
            btn.disabled = true;

            // Optional: restore setelah 10 detik jika stuck (fallback)
            setTimeout(function() {
                if (btn.disabled) {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }, 10000);
        }
    });

    // Reset button juga harus mereset loading state (optional)
    document.querySelector('button[type="reset"]')?.addEventListener('click', function() {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            btn.innerHTML = '<i class="fas fa-save mr-1 text-xs"></i>Simpan';
            btn.disabled = false;
        }
    });
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection