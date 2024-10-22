<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Informasi::where('status','1')->get()[0] ?? null;
        $text = $data->pengumuman ?? null;
        // dd($data->pengumuman);
        return view('session.siswa.index',compact('text'));
    }

    public function form()
    {
        $data = Jurusan::get();
        return view('session.siswa.form',['jurusan'=>$data]);
    }

    public function rekomendasi()
    {
        // $data = Jurusan::get();
        return view('session.siswa.rekomendasi');
    }
}
