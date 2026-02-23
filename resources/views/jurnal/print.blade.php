<!-- resources/views/jurnal/print.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jurnal Prakerin - SIPRAKERIN</title>
    @vite('resources/css/app.css')
    <style>
        @media print {
            @page {
                size: F4 landscape; /* Ubah ke landscape agar semua kolom muat */
                margin: 1cm;
            }
            body {
                background: white !important;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                box-shadow: none !important;
                padding: 0 !important;
            }
            th {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background-color: #3b5b8c !important;
                color: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-['Times_New_Roman'] p-4">

    <!-- Tombol Aksi (hanya muncul di layar) -->
    <div class="fixed bottom-5 right-5 z-50 flex gap-3 no-print">
        <button onclick="window.print()" 
                class="bg-[#3b5b8c] hover:bg-[#2a4a7a] text-white px-5 py-2.5 rounded-lg shadow-lg flex items-center gap-2 text-sm transition-all transform hover:scale-105">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="fixed bottom-5 left-5 z-50 no-print">
        <a href="{{ route('jurnal.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2.5 rounded-lg shadow-lg flex items-center gap-2 text-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Container Print -->
    <div class="print-container max-w-6xl mx-auto bg-white p-5 md:p-6 shadow-2xl rounded-xl my-8">
        
        <!-- Header Laporan -->
        <div class="text-center mb-3">
            <h1 class="text-base font-bold uppercase tracking-wide">LAPORAN JURNAL PRAKERIN</h1>
            <h2 class="text-sm font-semibold mt-0.5">UNIT PELAKSANA TEKNIS (UPT) KOMPUTER</h2>
            <p class="text-xs mt-0.5">Universitas PGRI Madiun</p>
            <p class="text-[10px] text-gray-600">Jalan Setia Budi No. 85 Madiun</p>
        </div>

        <!-- Informasi Cetak -->
        <div class="mb-3 text-[9px] border-b border-gray-300 pb-1.5">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex flex-wrap gap-2">
                    <div class="flex items-center">
                        <span class="font-semibold w-16">Tanggal Cetak</span>
                        <span>: {{ now()->format('d-m-Y H:i:s') }}</span>
                    </div>
                    
                    @if(request('search'))
                    <div class="flex items-center">
                        <span class="font-semibold w-14">Pencarian</span>
                        <span>: {{ request('search') }}</span>
                    </div>
                    @endif

                    @if(request('nis'))
                    <div class="flex items-center">
                        <span class="font-semibold w-10">NIS</span>
                        <span>: {{ request('nis') }}</span>
                    </div>
                    @endif
                </div>
                <div class="text-gray-600">Halaman 1</div>
            </div>
        </div>

        <!-- Tabel Data dengan Semua Kolom Lengkap -->
        <div class="overflow-x-auto">
            <table class="w-full text-[9px] border-collapse">
                <thead>
                    <tr class="bg-[#3b5b8c] text-white">
                        <th class="border border-gray-400 px-1 py-1 text-center w-[3%]">No</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[8%]">No Jurnal</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[6%]">NIS</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[10%]">Nama Siswa</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[12%]">Sekolah</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[12%]">Jurusan</th>
                        <th class="border border-gray-400 px-1 py-1 text-center w-[7%]">Tanggal</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[27%]">Kegiatan</th>
                        <th class="border border-gray-400 px-1 py-1 text-left w-[10%]">Tempat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurnals as $index => $jurnal)
                    <tr class="hover:bg-gray-50 even:bg-gray-50/50">
                        <td class="border border-gray-400 px-1 py-1 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->no_jurnal }}</td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->prakerin->nis ?? '-' }}</td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->prakerin->nama_siswa ?? '-' }}</td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->prakerin->sekolah->nama_sekolah ?? '-' }}</td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->prakerin->jurusan->nama_jurusan ?? '-' }}</td>
                        <td class="border border-gray-400 px-1 py-1 text-center whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d-m-Y') }}
                        </td>
                        <td class="border border-gray-400 px-1 py-1 break-words">
                            {{ $jurnal->kegiatan }}
                        </td>
                        <td class="border border-gray-400 px-1 py-1">{{ $jurnal->tempat }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="border border-gray-400 px-2 py-4 text-center text-gray-500">
                            Tidak ada data jurnal
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Total Data -->
        <div class="mt-2 text-[9px] flex justify-between items-center">
            <div>
                <span class="font-semibold">Total Jurnal:</span> 
                <span class="bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded-full text-[8px]">{{ $jurnals->count() }} Kegiatan</span>
            </div>
            <div class="text-gray-500 text-[8px]">
                Dicetak oleh: {{ auth()->user()->name ?? 'Sistem' }}
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="mt-4 flex justify-end">
            <div class="text-center w-48">
                <p class="text-[10px]">Madiun, {{ now()->format('d-m-Y') }}</p>
                <p class="text-[10px] mt-2">Kepala UPT Komputer</p>
                <div class="mt-6"></div>
                <p class="text-xs font-bold">Andria, S.Kom., M.Kom.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-3 pt-1.5 border-t border-gray-300 text-center">
            <p class="text-[7px] text-gray-600">
                Dokumen ini dicetak secara otomatis dari Sistem Informasi Prakerin (SIPRAKERIN) 
                UPT Komputer - Universitas PGRI Madiun
            </p>
        </div>
    </div>

    @stack('scripts')
    <script>
        // Auto print saat halaman dibuka (opsional)
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>