<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $data = Jurusan::query();

        // filter by nama
        $data->when($request->nama, function ($query) use ($request) {
            return $query->where('nama','like', '%'.$request->nama.'%');
        });

        //filter by status
        $data->when($request->status, function ($query) use ($request) {
            return $query->where('status','==', '%'.$request->status.'%');
        });

        return view('jurusan.index',['jurusan'=>$data->orderBy('created_at', 'desc')->get()]);
    }

    public function addForm(){
        return view('jurusan.form');
    }

    public function editForm($id){
        $data = Jurusan::where('id',$id)->first();
        return view('jurusan.form',['data'=>$data]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'singkatan' => 'required|string',
        ]);

        // 1. Simpan data Jurusan
        Jurusan::create([
            'nama' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
        ]);

        return redirect('master-data/jurusan')->with('success', 'Data berhasil diajukan!');

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'singkatan' => 'required|string',
        ]);

        $user = Jurusan::findOrFail($id);
        $user->update([
            'nama' => $validatedData['nama'],
            'singkatan' => $validatedData['singkatan'],
        ]);

        return redirect('master-data/jurusan')->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $jurusan = Jurusan::findOrFail($id); // Mengambil data berdasarkan ID
        $jurusan->delete(); // Menghapus data

        return redirect('master-data/jurusan')->with('success', 'Jurusan berhasil dihapus!');
    }
}
