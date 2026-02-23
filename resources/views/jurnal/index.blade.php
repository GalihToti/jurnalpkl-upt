@extends('layouts.app')

@section('title', 'Daftar Jurnal')

@section('content')

<div class="container mx-auto px-10 py-4">
    <!-- Breadcrumb -->
    <div class="mb-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-xs font-medium text-gray-600 hover:text-blue-600 transition">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1 text-xs"></i>
                        <span class="text-xs font-medium text-[#3b5b8c]">Daftar Jurnal</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header dengan gradient biru terang -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-400 rounded-xl shadow-lg p-5 mb-4 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-1">
                    Daftar Jurnal PKL
                </h1>
                <p class="text-white/80 text-sm">Kelola jurnal kegiatan harian siswa</p>
            </div>
            <div class="bg-white/20 px-2 py-1 rounded-full">
                <i class="fas fa-book text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Search Bar dan Tombol Cetak -->
    <div class="bg-white rounded-lg shadow-sm p-3 mb-4 border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <form method="GET" action="{{ route('jurnal.index') }}" class="flex w-full md:w-auto gap-1.5">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-xs"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama siswa, sekolah..."
                        class="w-full md:w-72 border border-gray-200 rounded-lg pl-8 pr-3 py-2 text-xs focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition">
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3.5 py-2 rounded-lg text-xs font-medium transition flex items-center gap-1">
                    <i class="fas fa-search text-xs"></i>
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('jurnal.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-xs font-medium transition flex items-center gap-1">
                    <i class="fas fa-times"></i>
                    Reset
                </a>
                @endif
            </form>

            <a href="{{ route('jurnal.print', request()->all()) }}"
                target="_blank"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-medium transition flex items-center gap-1.5 shadow-sm w-full md:w-auto justify-center">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan Jurnal
            </a>
        </div>
        
        <!-- Info filter aktif -->
        @if(request('search'))
        <div class="mt-2 text-xs text-gray-600 bg-blue-50 px-2 py-1.5 rounded">
            <i class="fas fa-filter mr-1 text-blue-500 text-xs"></i>
            Filter aktif: "{{ request('search') }}"
        </div>
        @endif
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-[11px]">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="px-2 py-2 text-center border-r border-white/20 w-10">No</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">No Jurnal</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">Waktu Input</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">Nama Siswa</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">Asal Sekolah</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">Kegiatan</th>
                        <th class="px-2 py-2 text-left border-r border-white/20">Tempat</th>
                        <th class="px-2 py-2 text-center border-r border-white/20">Tanggal</th>
                        <th class="px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($jurnal as $index => $item)
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-2 py-2 text-center text-gray-700">{{ $jurnal->firstItem() + $index }}</td>
                        <td class="px-2 py-2 font-medium text-gray-800">{{ $item->no_jurnal }}</td>
                        <td class="px-2 py-2 text-gray-700 whitespace-nowrap text-[10px]">
                            {{ \Carbon\Carbon::parse($item->waktu)->format('d-m-Y H:i') }}
                        </td>
                        <td class="px-2 py-2 font-medium text-gray-800">{{ $item->prakerin->nama_siswa ?? '-' }}</td>
                        <td class="px-2 py-2 text-gray-700">{{ $item->prakerin->sekolah->nama_sekolah ?? '-' }}</td>
                        <td class="px-2 py-2 text-gray-700 max-w-[150px] truncate" title="{{ $item->kegiatan }}">
                            {{ $item->kegiatan }}
                        </td>
                        <td class="px-2 py-2 text-gray-700">{{ $item->tempat }}</td>
                        <td class="px-2 py-2 text-center text-gray-700 whitespace-nowrap text-[10px]">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>
                        <td class="px-2 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('jurnal.show', $item->id) }}"
                                    class="bg-blue-50 hover:bg-blue-100 text-blue-600 p-1 rounded transition" title="Detail">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('jurnal.edit', $item->id) }}"
                                    class="bg-yellow-50 hover:bg-yellow-100 text-yellow-600 p-1 rounded transition" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('jurnal.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-50 hover:bg-red-100 text-red-600 p-1 rounded transition" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm font-medium">Belum ada data jurnal</p>
                                <p class="text-xs mt-1">Silakan tambah data baru melalui menu Jurnal</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Tabel -->
        <div class="bg-gray-50 px-3 py-2 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-2 text-xs">
            <div class="text-gray-600">
                <i class="fas fa-database mr-1 text-blue-500 text-xs"></i>
                Total: <span class="font-semibold">{{ $jurnal->total() }}</span> record
                @if($jurnal->total() > 0)
                <span class="text-gray-500 ml-1 text-[10px]">
                    (Hal {{ $jurnal->currentPage() }}/{{ $jurnal->lastPage() }})
                </span>
                @endif
            </div>
            
            <!-- Pagination dengan Tailwind classes -->
            @if($jurnal->hasPages())
            <div class="flex items-center gap-1">
                {{-- Previous Page Link --}}
                @if($jurnal->onFirstPage())
                <span class="px-2 py-1 text-gray-400 bg-gray-100 rounded border border-gray-200 text-xs cursor-not-allowed">«</span>
                @else
                <a href="{{ $jurnal->previousPageUrl() }}" class="px-2 py-1 text-gray-700 bg-white rounded border border-gray-200 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition text-xs">«</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach($jurnal->getUrlRange(1, $jurnal->lastPage()) as $page => $url)
                    @if($page == $jurnal->currentPage())
                    <span class="px-2 py-1 text-white bg-blue-500 rounded border border-blue-500 text-xs">{{ $page }}</span>
                    @elseif($page >= $jurnal->currentPage() - 2 && $page <= $jurnal->currentPage() + 2)
                    <a href="{{ $url }}" class="px-2 py-1 text-gray-700 bg-white rounded border border-gray-200 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition text-xs">{{ $page }}</a>
                    @elseif($page == $jurnal->currentPage() - 3 || $page == $jurnal->currentPage() + 3)
                    <span class="px-2 py-1 text-gray-400">...</span>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($jurnal->hasMorePages())
                <a href="{{ $jurnal->nextPageUrl() }}" class="px-2 py-1 text-gray-700 bg-white rounded border border-gray-200 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition text-xs">»</a>
                @else
                <span class="px-2 py-1 text-gray-400 bg-gray-100 rounded border border-gray-200 text-xs cursor-not-allowed">»</span>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection