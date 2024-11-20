<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index($status){
        $set_status = explode('-', $status);
        $data = Surat::with('jurusan')->where('status', $set_status[1])->orderBy('created_at', 'desc')->get();
        return view('persuratan.'.$set_status[1].'.index',['surat'=>$data]);
    }

    public function addForm(){
            $jurusan = Jurusan::orderBy('created_at', 'desc')->get();
            return view('persuratan.draft.form',['jurusan'=>$jurusan]);
    }

    public function editForm($id){
        $jurusan = Jurusan::get();
        $data = Surat::with('jurusan')->with('anggota')->where('id',$id)->first();
        // dd($data);
        return view('persuratan.draft.form',['jurusan'=>$jurusan,'data'=>$data]);
    }

    public function store(Request $request)
        {
            // Validasi data
            $validatedData = $request->validate([
                'jurusan' => 'required|exists:jurusans,id',
                'perusahaan' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|string',
                'anggota' => 'required|array',
                'anggota.*.nama' => 'required|string',
                'anggota.*.nis' => 'required|string',
            ]);

            // 1. Simpan data pengajuan surat
            $pengajuanSurat = Surat::create([
                'jurusan_id' => intval($validatedData['jurusan']),
                'perusahaan' => $validatedData['perusahaan'],
                'status' => 'draft',
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

            if (Auth::check()) {
                return redirect()->route('surat',['status'=>'surat-draft'])->with('success', 'Data berhasil diajukan!');
            }

            return redirect()->route('informasi')->with('success', 'Data berhasil diajukan!');
    }
}
