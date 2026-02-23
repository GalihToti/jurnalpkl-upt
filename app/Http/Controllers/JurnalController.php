<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Prakerin;
use Illuminate\Http\Request;

class JurnalController extends Controller
{

    private function generateNoJurnal()
    {
        $last = Jurnal::orderBy('id', 'desc')->first();
        $nextNumber = $last ? ((int)$last->no_jurnal + 1) : 1;

        return $nextNumber;
    }

    public function index(Request $request)
    {
        $query = Jurnal::with(['prakerin.sekolah', 'prakerin.jurusan']); // load relasi

        // fitur search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // search berdasarkan nama siswa dari relasi prakerin
                $q->whereHas('prakerin', function ($q2) use ($search) {
                    $q2->where('nama_siswa', 'like', "%$search%")
                        ->orWhereHas('sekolah', function ($q3) use ($search) {
                            $q3->where('nama_sekolah', 'like', "%$search%");
                        })
                        ->orWhereHas('jurusan', function ($q4) use ($search) {
                            $q4->where('nama_jurusan', 'like', "%$search%");
                        });
                });
            });
        }

        $query->orderBy('created_at', 'desc');

        // pagination + supaya search tidak hilang saat pindah halaman
        /** @var \Illuminate\Pagination\LengthAwarePaginator $jurnal */
        $jurnal = $query->paginate(5);
        $jurnal->withQueryString();

        return view('jurnal.index', compact('jurnal'));
    }

    public function show($id)
    {
        $jurnal = Jurnal::with(['prakerin.sekolah', 'prakerin.jurusan'])->findOrFail($id);

        return view('jurnal.show', [
            'jurnal' => $jurnal,
            'prakerin' => $jurnal->prakerin
        ]);
    }

    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $prakerin = Prakerin::with('sekolah')->get();

        return view('jurnal.edit', compact('jurnal', 'prakerin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'tempat'     => 'required|string',
            'kegiatan'   => 'required|string',
        ], [
            'tanggal.required' => 'Tanggal kegiatan harus diisi.',
            'tempat.required'  => 'Tempat kegiatan harus diisi.',
            'kegiatan.required' => 'Kegiatan harus diisi.',
        ]);

        $jurnal = Jurnal::findOrFail($id);

        $jurnal->update([
            'tanggal'   => $request->tanggal,
            'tempat'    => $request->tempat,
            'kegiatan'  => $request->kegiatan,
        ]);

        return redirect()->route('jurnal.index')
            ->with('success', 'Data Jurnal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->route('jurnal.index')
            ->with('success', 'Data Jurnal berhasil dihapus');
    }


    public function create(Prakerin $prakerin)
    {
        $noJurnal = $this->generateNoJurnal();
        return view('jurnal.create', [
            'noJurnalPreview' => $noJurnal,
        ]);
    }

    // Simpan jurnal
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'tanggal' => 'required|date',
            'tempat' => 'required',
            'kegiatan' => 'required'
        ]);

        // Cari prakerin berdasarkan NIS
        $prakerin = Prakerin::where('nis', $request->nis)->first();

        if (!$prakerin) {
            return back()->with('error', 'NIS tidak ditemukan dalam data prakerin')
                ->withInput();
        }

        Jurnal::create([
            'no_jurnal' => $request->no_jurnal,
            'waktu' => now(), // tetap ambil dari server
            'prakerin_id' => $prakerin->id,
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'kegiatan' => $request->kegiatan,
        ]);

        return back()->with('success', 'Jurnal berhasil disimpan');
    }

    public function printLaporan(Request $request)
    {
        try {
            $query = Jurnal::with(['prakerin', 'prakerin.sekolah', 'prakerin.jurusan']);

            // Fitur search
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('kegiatan', 'like', "%$search%")
                        ->orWhere('tempat', 'like', "%$search%")
                        ->orWhere('no_jurnal', 'like', "%$search%")
                        ->orWhereHas('prakerin', function ($q2) use ($search) {
                            $q2->where('nama_siswa', 'like', "%$search%")
                                ->orWhere('nis', 'like', "%$search%");
                        });
                });
            }

            // Filter berdasarkan NIS
            if ($request->filled('nis')) {
                $query->whereHas('prakerin', function ($q) use ($request) {
                    $q->where('nis', $request->nis);
                });
            }

            // Filter berdasarkan tanggal
            if ($request->filled('tanggal')) {
                $query->whereDate('tanggal', $request->tanggal);
            }

            // Urutkan
            $jurnals = $query->orderBy('tanggal', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            // Kirim ke view
            return view('jurnal.print', compact('jurnals'));
        } catch (\Exception $e) {
            // Jika error, redirect back dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
