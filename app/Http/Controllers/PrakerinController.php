<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Prakerin;
use App\Models\Sekolah;
use App\Models\Jurusan;
use Exception;

class PrakerinController extends Controller
{
    private function generateNoPendataan()
    {
        $last = Prakerin::orderBy('id', 'desc')->first();

        $nextNumber = $last ? ((int)$last->no_pendataan + 1) : 1;
        return str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $noPendataan = $this->generateNoPendataan();
        return view('prakerin.create', [
            'sekolah' => Sekolah::orderBy('nama_sekolah')->get(),
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),
            'noPendataanPreview' => $noPendataan,
        ]);
    }

    public function index(Request $request)
    {
        $query = Prakerin::with(['sekolah', 'jurusan']);

        // fitur search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%$search%")
                    ->orWhereHas('sekolah', function ($q2) use ($search) {
                        $q2->where('nama_sekolah', 'like', "%$search%");
                    })
                    ->orWhereHas('jurusan', function ($q3) use ($search) {
                        $q3->where('nama_jurusan', 'like', "%$search%");
                    });
            });
        }

        $query->orderBy('created_at', 'desc');

        // pagination + supaya search tidak hilang saat pindah halaman
        /** @var \Illuminate\Pagination\LengthAwarePaginator $prakerin */
        $prakerin = $query->paginate(5);
        $prakerin->withQueryString();

        return view('prakerin.index', compact('prakerin'));
    }

    public function getSiswaByNis($nis)
    {
        $prakerin = Prakerin::with(['sekolah', 'jurusan'])
            ->where('nis', $nis)
            ->first();

        if ($prakerin) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'nama_siswa' => $prakerin->nama_siswa,
                    'sekolah' => $prakerin->sekolah->nama_sekolah ?? '-',
                    'jurusan' => $prakerin->jurusan->nama_jurusan ?? '-',
                    'tanggal_mulai' => $prakerin->tanggal_mulai_prakerin->format('d-m-Y'),
                    'tanggal_akhir' => $prakerin->tanggal_akhir_prakerin->format('d-m-Y')
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'NIS tidak ditemukan'
            ]);
        }
    }

    public function printLaporan(Request $request)
    {
        $query = Prakerin::with(['sekolah', 'jurusan']);

        // Fitur search (sama seperti di index)
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%$search%")
                    ->orWhereHas('sekolah', function ($q2) use ($search) {
                        $q2->where('nama_sekolah', 'like', "%$search%");
                    })
                    ->orWhereHas('jurusan', function ($q3) use ($search) {
                        $q3->where('nama_jurusan', 'like', "%$search%");
                    });
            });
        }

        $prakerin = $query->orderBy('created_at', 'desc')->get();

        return view('prakerin.print', compact('prakerin'));
    }

    public function show($id)
    {
        $prakerin = Prakerin::with(['sekolah', 'jurusan'])
            ->findOrFail($id);

        return view('prakerin.show', compact('prakerin'));
    }

    public function edit($id)
    {
        $prakerin = Prakerin::findOrFail($id);

        return view('prakerin.edit', [
            'prakerin' => $prakerin,
            'sekolah' => Sekolah::orderBy('nama_sekolah')->get(),
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|numeric|digits_between:1,12',
            'nama_siswa' => 'required',
            'id_sekolah' => 'required',
            'id_jurusan' => 'required',
            'tanggal_mulai_prakerin' => 'required|date',
            'tanggal_akhir_prakerin' => 'required|date|after:tanggal_mulai_prakerin',
        ]);

        $prakerin = Prakerin::findOrFail($id);

        $prakerin->update($request->all());

        return redirect()->route('prakerin.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $prakerin = Prakerin::findOrFail($id);
        $prakerin->delete();

        return redirect()->route('prakerin.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function store(Request $request)
    {
        // CEK MANUAL NIS DUPLICATE SEBELUM VALIDASI
        $existingPrakerin = Prakerin::where('nis', $request->nis)->first();

        if ($existingPrakerin) {
            return redirect()->back()
                ->withInput()
                ->with('nis_error', 'NIS sudah terdaftar!')
                ->with('nis_duplicate', $request->nis)
                ->with('nama_duplicate', $existingPrakerin->nama_siswa);
        }

        //VALIDASI AWAL
        $request->validate([
            'nis' => 'required|numeric|digits_between:1,12',
            'nama_siswa' => 'required|string|min:3|max:50',
            'id_sekolah' => 'required',
            'id_jurusan' => 'required',
            'tanggal_mulai_prakerin' => 'required|date|after_or_equal:' . now()->toDateString(),
            'tanggal_akhir_prakerin' => 'required|date|after:tanggal_mulai_prakerin',
            'g-recaptcha-response' => 'required',
        ]);

        // Verifikasi CAPTCHA
        $captchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
            ]
        );

        if (!$captchaResponse->json('success')) {
            return back()->withErrors([
                'g-recaptcha-response' => 'Captcha tidak valid'
            ])->withInput();
        }

        $noPendataan = null;

        try {
            DB::transaction(function () use ($request, &$noPendataan) {

                // VALIDASI SEKOLAH
                if ($request->id_sekolah === 'lainnya') {
                    $request->validate([
                        'sekolah_lain' => 'required|string|min:3|max:100'
                    ]);

                    $sekolah = Sekolah::firstOrCreate([
                        'nama_sekolah' => $request->sekolah_lain
                    ]);

                    $idSekolah = $sekolah->id_sekolah;
                } else {
                    $idSekolah = $request->id_sekolah;
                }

                // VALIDASI JURUSAN
                if ($request->id_jurusan === 'lainnya') {
                    $request->validate([
                        'jurusan_lain' => 'required|string|min:3|max:100'
                    ]);

                    $jurusan = Jurusan::firstOrCreate([
                        'nama_jurusan' => $request->jurusan_lain
                    ]);

                    $idJurusan = $jurusan->id_jurusan;
                } else {
                    $idJurusan = $request->id_jurusan;
                }

                //NO PENDATAAN
                $noPendataan = $this->generateNoPendataan();

                //SIMPAN PRAKERIN
                Prakerin::create([
                    'no_pendataan' => $noPendataan,
                    'nis' => $request->nis,
                    'nama_siswa' => $request->nama_siswa,
                    'id_sekolah' => $idSekolah,
                    'id_jurusan' => $idJurusan,
                    'tanggal_mulai_prakerin' => $request->tanggal_mulai_prakerin,
                    'tanggal_akhir_prakerin' => $request->tanggal_akhir_prakerin,
                ]);
            });

            return redirect()
                ->route('prakerin.create')
                ->with('success', 'Pendaftaran berhasil!')
                ->with('no_pendataan', $noPendataan);
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Gagal menyimpan data: ' . $e->getMessage()
            ])->withInput();
        }
    }
}
