<!-- resources/views/jurnal/print-detail.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Detail Jurnal - SIPRAKERIN</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @media print {
            @page {
                size: F4;
                margin: 1.5cm;
            }

            body {
                background: white !important;
                font-family: 'Times New Roman', Times, serif !important;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                box-shadow: none !important;
                padding: 0 !important;
            }

            .header-gradient {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: linear-gradient(to right, #1e4b8c, #2563eb) !important;
            }
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .print-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <!-- Tombol Aksi (hanya muncul di layar) -->
    <div class="fixed bottom-5 right-5 z-50 no-print flex gap-3">
        <button onclick="window.print()"
            class="bg-[#3b5b8c] hover:bg-[#2a4a7a] text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 text-base transition-all transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="fixed bottom-5 left-5 z-50 no-print">
        <a href="javascript:history.back()"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 text-base transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Container Print -->
    <div class="print-container">

        <!-- Header dengan logo dan gradient biru -->
        <div class="header-gradient bg-gradient-to-r from-[#1e4b8c] to-[#2563eb] text-white px-6 py-5 -mt-8 -mx-8 mb-6" style="margin-top: -30px; margin-left: -40px; margin-right: -40px; padding-top: 35px; padding-bottom: 20px;">
            <!-- Container flex untuk logo dan teks -->
            <div class="flex items-center">
                <!-- Logo di kiri -->
                <div class="flex-shrink-0 mr-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UPT Komputer"
                        class="w-16 h-16 object-contain bg-white/10 p-1 rounded-full"
                        onerror="this.style.display='none'">
                </div>

                <!-- Teks di tengah -->
                <div class="flex-grow text-center">
                    <h1 class="text-xl font-bold uppercase tracking-wide leading-tight">UNIT PELAKSANA TEKNIS (UPT) KOMPUTER</h1>
                    <h2 class="text-lg font-normal leading-snug">Universitas PGRI Madiun</h2>
                </div>

                <!-- Spacer -->
                <div class="w-20 flex-shrink-0"></div>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center mb-5">
            <h3 class="font-bold text-base uppercase tracking-wider border-b-2 border-black inline-block px-6 pb-1">
                FORM PENDATAAN JURNAL PRAKERIN
            </h3>
            <h4 class="font-bold text-sm mt-1 uppercase">UPT KOMPUTER - UNIPMA</h4>
        </div>

        <!-- Informasi Cetak -->
        <div class="mb-4 text-xs border-b border-gray-300 pb-2 flex justify-between">
            <div>Tanggal Cetak: {{ now()->format('d-m-Y H:i:s') }}</div>
            <div class="text-gray-500">Dicetak dari sistem SIPRAKERIN</div>
        </div>

        <!-- Data Table -->
        <table class="w-full text-sm">
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Nomor Jurnal</td>
                <td class="py-2 pl-2">: {{ $jurnal->no_jurnal ?? 'JRN-001/2025' }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">NIS</td>
                <td class="py-2 pl-2">: {{ $prakerin->nis ?? '5156' }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Nama Siswa</td>
                <td class="py-2 pl-2">: {{ strtoupper($prakerin->nama_siswa ?? 'DWI AGUSTINA') }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Asal Sekolah</td>
                <td class="py-2 pl-2">: {{ strtoupper($prakerin->sekolah->nama_sekolah ?? 'SMKN 1 JIWAN') }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Jurusan</td>
                <td class="py-2 pl-2">: {{ strtoupper($prakerin->jurusan->nama_jurusan ?? 'TEKNIK KOMPUTER DAN JARINGAN') }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Tanggal Kegiatan</td>
                <td class="py-2 pl-2">: {{ $jurnal->tanggal ? \Carbon\Carbon::parse($jurnal->tanggal)->format('d-m-Y') : '15-07-2025' }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Tempat</td>
                <td class="py-2 pl-2">: {{ $jurnal->tempat ?? 'Laboratorium Komputer' }}</td>
            </tr>
            <tr class="align-top">
                <td class="font-bold w-48 py-2">Kegiatan</td>
                <td class="py-2 pl-2 text-justify">: {{ $jurnal->kegiatan ?? 'Melakukan instalasi sistem operasi dan konfigurasi jaringan' }}</td>
            </tr>
        </table>

        <!-- Tanda Tangan -->
        <div class="flex justify-end mt-16">
            <div class="text-center w-64">
                <p class="text-sm">Madiun, {{ now()->format('d-m-Y') }}</p>
                <p class="text-sm mt-6">Kepala UPT Komputer</p>
                <br><br><br>
                <p class="text-base font-bold">Andria, S.Kom., M.Kom.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-[9px] text-gray-500 text-center mt-8 border-t border-gray-300 pt-3">
            <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Prakerin (SIPRAKERIN) UPT Komputer - UNIPMA</p>
        </div>
    </div>

    <script>
        // Auto print saat halaman dibuka (opsional)
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>