@extends('layouts.app')

@section('title', 'Edit Jurnal Prakerin')

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
                        <span class="text-xs font-medium text-[#3b5b8c]">Edit Jurnal</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-xl shadow-lg p-5 mb-4 text-white">
        <h1 class="text-2xl font-bold mb-1">
            Edit Jurnal Prakerin
        </h1>
        <p class="text-white/80 text-sm">Ubah data jurnal kegiatan harian prakerin</p>
    </div>

    <!-- Notifikasi Error -->
    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
            <div>
                <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg shadow-md mb-4 flex items-start">
        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-0.5"></i>
        <div>
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-100">
        <form action="{{ route('jurnal.update', $jurnal->id) }}" method="POST" class="space-y-4" id="jurnalForm">
            @csrf
            @method('PUT')

            <!-- No Jurnal & Waktu Input (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- No Jurnal (readonly) -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 rounded-lg border border-blue-100">
                    <label class="block text-xs font-semibold text-gray-800 mb-1">
                        <i class="fas fa-hashtag mr-1 text-[#3b5b8c] text-xs"></i>No Jurnal
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-[#3b5b8c] font-bold text-sm">#</span>
                            </div>
                            <input
                                type="text"
                                value="{{ $jurnal->no_jurnal }}"
                                readonly
                                class="w-full bg-gray-100 border border-gray-300 text-gray-700 text-sm font-bold rounded-lg pl-7 p-2.5 cursor-not-allowed">
                        </div>
                        <span class="text-xs text-gray-600 bg-white px-2 py-1 rounded-full border border-gray-200 whitespace-nowrap">
                            <i class="fas fa-lock mr-1 text-[#3b5b8c] text-xs"></i>
                            Tidak bisa diubah
                        </span>
                    </div>
                </div>

                <!-- Waktu Input (readonly) -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-3 rounded-lg border border-gray-200">
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-clock mr-1 text-[#3b5b8c] text-xs"></i>Waktu Input
                    </label>
                    <input
                        type="text"
                        value="{{ \Carbon\Carbon::parse($jurnal->waktu)->format('d-m-Y H:i:s') }}"
                        readonly
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg p-2.5 cursor-not-allowed">
                </div>
            </div>

            <!-- Data Siswa (Readonly) -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user-graduate mr-2 text-[#3b5b8c]"></i>
                    Data Siswa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-xs text-gray-500">NIS</p>
                        <p class="font-medium text-gray-800">{{ $jurnal->prakerin->nis ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Nama Siswa</p>
                        <p class="font-medium text-gray-800">{{ $jurnal->prakerin->nama_siswa ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Asal Sekolah</p>
                        <p class="font-medium text-gray-800">{{ $jurnal->prakerin->sekolah->nama_sekolah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Jurusan</p>
                        <p class="font-medium text-gray-800">{{ $jurnal->prakerin->jurusan->nama_jurusan ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-3 text-xs text-blue-600 bg-blue-50 p-2 rounded">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data siswa tidak dapat diubah. Untuk mengubah data siswa, edit melalui menu Prakerin.
                </div>
            </div>

            <!-- Grid 2 Kolom untuk Tanggal dan Tempat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
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
                            value="{{ old('tanggal', \Carbon\Carbon::parse($jurnal->tanggal)->format('Y-m-d')) }}"
                            class="w-full border border-gray-200 rounded-lg p-2.5 pl-8 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                            required>
                    </div>
                </div>

                <!-- Tempat -->
                <div>
                    <label for="tempat" class="block text-xs font-semibold text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-[#3b5b8c] text-xs"></i>Tempat
                    </label>
                    <input
                        type="text"
                        id="tempat"
                        name="tempat"
                        value="{{ old('tempat', $jurnal->tempat) }}"
                        placeholder="Lokasi kegiatan"
                        class="w-full border border-gray-200 rounded-lg p-2.5 text-sm text-gray-700 focus:border-[#3b5b8c] focus:ring-2 focus:ring-[#3b5b8c]/10 transition-all"
                        required>
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
                    required>{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
            </div>

            <!-- Form Actions -->
            <div class="pt-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
                    <div class="text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
                        <i class="fas fa-exclamation-circle mr-1 text-[#3b5b8c]"></i>
                        Pastikan data jurnal sudah benar
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('jurnal.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm py-2 px-4 rounded-lg transition-all border border-gray-200 flex items-center">
                            <i class="fas fa-times mr-1 text-xs"></i>Batal
                        </a>
                        <button type="submit" id="submitBtn"
                            class="bg-gradient-to-r from-[#3b5b8c] to-[#4a6b9e] hover:from-[#2a4a7a] hover:to-[#3b5b8c] text-white font-medium text-sm py-2 px-5 rounded-lg transition-all transform hover:scale-105 shadow flex items-center">
                            <i class="fas fa-save mr-1 text-xs"></i>Update Jurnal
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
    // Loading state saat submit
    document.getElementById('jurnalForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        if (btn) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1 text-xs"></i>Menyimpan...';
            btn.disabled = true;
        }
    });

    // Validasi form sebelum submit (opsional)
    document.getElementById('jurnalForm')?.addEventListener('submit', function(e) {
        const tanggal = document.getElementById('tanggal').value;
        const tempat = document.getElementById('tempat').value;
        const kegiatan = document.getElementById('kegiatan').value;

        if (!tanggal || !tempat || !kegiatan) {
            e.preventDefault();
            alert('Semua field harus diisi!');
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-save mr-1 text-xs"></i>Update Jurnal';
            document.getElementById('submitBtn').disabled = false;
        }
    });
</script>
@endsection