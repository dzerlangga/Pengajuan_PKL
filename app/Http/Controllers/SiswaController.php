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

    public function rekomendasi()
    {
        $data = Perusahaan::orderBy('nama', 'asc')->get();
        return view('session.siswa.rekomendasi',['data'=>$data]);
    }
}
