<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Perusahaan;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Program::where('status','1')->get()[0] ?? null;
        $text = $data->pengumuman ?? null;
        $id_program = $data->id ?? null;
        return view('session.siswa.index',['text'=> $text,'id'=>$id_program]);
    }

    public function form()
    {
        $data = Program::where('status','1')->get()[0] ?? null;
        $id_program =  $data->id ?? null;
        $data = Jurusan::get();
        return view('session.siswa.form',['jurusan'=>$data,'id_program'=>$id_program]);
    }

    public function rekomendasi(Request $request)
    {
        $search = $request->input('search', '');

        $data = Perusahaan::where('nama', 'like', "%{$search}%")->orderBy('nama', 'asc');

        if ($request->ajax()) {
            return view('session.siswa.tableRekomendasi', ['datas'=>$data->paginate(5)])->render();
        }

        $data = Perusahaan::select('nama','website','alamat')->orderBy('nama', 'asc')->paginate(5);
        return view('session.siswa.rekomendasi',['datas'=>$data]);
    }
}
