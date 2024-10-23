<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function store(Request $request)
        {
            // dd($request);
            // Validasi data
            $validatedData = $request->validate([
                'jurusan' => 'required|string',
                'perusahaan' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|string',
                'anggota' => 'required|array',
                'anggota.*.nama' => 'required|string',
                'anggota.*.nis' => 'required|string',
            ]);

            // 1. Simpan data pengajuan surat
            $pengajuanSurat = Surat::create([
                'jurusan' => $validatedData['jurusan'],
                'perusahaan' => $validatedData['perusahaan'],
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_hp'],
            ]);

            // 2. Simpan data anggota (array)
            foreach ($validatedData['anggota'] as $anggota) {
                $pengajuanSurat->anggota()->create([
                    'nama' => $anggota['nama'],
                    'nis' => $anggota['nis'],
                    'surat_id' => $pengajuanSurat->id,
                ]);
            }

            return redirect()->route('pengumuman')->with('success', 'Data berhasil diajukan!');
    }
}
