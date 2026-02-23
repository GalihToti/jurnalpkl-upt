<!-- resources/views/prakerin/print.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Prakerin - SIPRAKERIN</title>
    @vite('resources/css/app.css')
    <style>
        @media print {
            @page {
                size: F4;
                margin: 1.5cm;
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
            class="bg-[#3b5b8c] hover:bg-[#2a4a7a] text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 transition-all transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="fixed bottom-5 left-5 z-50 no-print">
        <a href="{{ route('prakerin.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Container Print -->
    <div class="print-container max-w-5xl mx-auto bg-white p-8 md:p-12 shadow-2xl rounded-xl my-8">

        <!-- Header Laporan -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold uppercase tracking-wide">LAPORAN PENDATAAN PRAKERIN</h1>
            <h2 class="text-xl font-semibold mt-2">UNIT PELAKSANA TEKNIS (UPT) KOMPUTER</h2>
            <p class="text-base mt-1">Universitas PGRI Madiun</p>
            <p class="text-sm text-gray-600">Jalan Setia Budi No. 85 Madiun</p>
        </div>

        <!-- Informasi Cetak -->
        <div class="mb-6 text-sm border-b border-gray-300 pb-4">
            <div class="flex flex-col sm:flex-row justify-between gap-2">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <span class="font-semibold w-24">Tanggal Cetak</span>
                        <span>: {{ now()->format('d-m-Y H:i:s') }}</span>
                    </div>

                    @if(request('search'))
                    <div class="flex items-center">
                        <span class="font-semibold w-20">Pencarian</span>
                        <span>: {{ request('search') }}</span>
                    </div>
                    @endif

                    @if(request('sekolah'))
                    <div class="flex items-center">
                        <span class="font-semibold w-24">Filter Sekolah</span>
                        <span>: {{ request('sekolah') }}</span>
                    </div>
                    @endif
                </div>
                <div class="text-gray-600 sm:text-right">Halaman 1</div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-[#3b5b8c] text-white">
                        <th class="border border-gray-300 px-3 py-2.5 text-center w-12">No</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-left">NIS</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-left">Nama Siswa</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-left">Asal Sekolah</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-left">Jurusan</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-center">Tgl Mulai</th>
                        <th class="border border-gray-300 px-3 py-2.5 text-center">Tgl Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prakerin as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-3 py-2.5 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-3 py-2.5">{{ $item->nis }}</td>
                        <td class="border border-gray-300 px-3 py-2.5">{{ $item->nama_siswa }}</td>
                        <td class="border border-gray-300 px-3 py-2.5">{{ $item->sekolah->nama_sekolah ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2.5">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2.5 text-center whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai_prakerin)->format('d-m-Y') }}
                        </td>
                        <td class="border border-gray-300 px-3 py-2.5 text-center whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal_akhir_prakerin)->format('d-m-Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-3 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-base">Tidak ada data prakerin</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Total Data -->
        <div class="mt-4 text-sm flex justify-between items-center">
            <div>
                <span class="font-semibold">Total Data:</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">{{ $prakerin->count() }} Siswa</span>
            </div>
            <div class="text-gray-500 text-xs">
                Dicetak oleh: {{ auth()->user()->name ?? 'Sistem' }}
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="mt-16 flex justify-end">
            <div class="text-center w-64">
                <p class="text-base">Madiun, {{ now()->format('d-m-Y') }}</p>
                <p class="text-base mt-6">Kepala UPT Komputer</p>
                <br><br><br>
                <p class="text-lg font-bold">Andria, S.Kom., M.Kom.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-4 border-t border-gray-300 text-center">
            <p class="text-xs text-gray-600">
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