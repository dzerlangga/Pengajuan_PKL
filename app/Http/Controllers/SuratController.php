<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Program;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function index(Request $request, $status){

        $search = $request->input('search', '');

        $set_status = explode('-', $status);
        $data = Surat::with('jurusan') // Memuat data relasi jurusan
        ->where('status', '=', $set_status[1]) // Filter status
        ->where(function ($query) use ($search) { // Grupkan kondisi lainnya
            $query->where('perusahaan', 'like', "%{$search}%")
                  ->orWhereHas('jurusan', function ($jurusanQuery) use ($search) {
                      $jurusanQuery->where('nama', 'like', "%{$search}%")
                                   ->orWhere('singkatan', 'like', "%{$search}%");
                  });
        })
        ->orderBy('created_at', 'desc');

        if ($request->ajax()) {
            return view('persuratan.'.$set_status[1].'.table', ['datas'=>$data->paginate(5)])->render();
        }

        return view('persuratan.'.$set_status[1].'.index',['datas'=>$data->paginate(5)]);
    }

    public function addForm(){
            $jurusan = Jurusan::orderBy('created_at', 'desc')->get();
            $program = Program::where('status',1)->orderBy('created_at', 'desc')->get();
            return view('persuratan.draft.form',['jurusan'=>$jurusan,'program'=>$program]);
    }

    public function editForm($status,$id){
        $set_status = explode('-', $status);
        $jurusan = Jurusan::orderBy('created_at', 'desc')->get();
        $program = Program::orderBy('created_at', 'desc')->get();
        $data = Surat::with('jurusan')->with('anggota')->where('id',$id)->first();
        return view('persuratan.'. $set_status[1] .'.form',['jurusan'=>$jurusan,'program'=>$program,'data'=>$data, 'id'=>$id]);
    }

    public function editStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:draf,accept,reject',
        ]);

        // Update status
        $surat = Surat::findOrFail($id);
        $surat->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully!']);
    }

    public function store(Request $request)
        {
            // Validasi data
            $validatedData = $request->validate([
                'jurusan' => 'required|exists:jurusans,id',
                'program' => 'required|exists:programs,id',
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
                'program_id' => intval($validatedData['program']),
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

            return redirect()->route('program')->with('success', 'Data berhasil diajukan!');
    }

    public function delete($id)
    {
        $surat = Surat::findOrFail($id); // Mengambil data berdasarkan ID
        $surat->delete(); // Menghapus data

        return redirect('persuratan/surat-draft')->with('success', 'Surat berhasil dihapus!');
    }
}
