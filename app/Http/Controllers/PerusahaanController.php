<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $data = Perusahaan::where('nama', 'like', "%{$search}%");

        if ($request->ajax()) {
            return view('perusahaan.table', ['datas'=>$data->orderBy('created_at', 'desc')->paginate(5)])->render();
        }

        return view('perusahaan.index',['datas'=>$data->orderBy('created_at', 'desc')->paginate(5)]); //menuju halaman utama perusahaan dan menampilkan data
    }

    public function addForm(){
        return view('perusahaan.form'); //menampilkan halaman tambah
    }

    public function editForm($id){
        $data = Perusahaan::where('id',$id)->first(); //mencari data berdasarkan id
        return view('perusahaan.form',['data'=>$data]); //menampilkan halaman edit
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
        ]);

        // 1. Simpan data perusahaan
        Perusahaan::create([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'kontak' => $validatedData['kontak'],
            'website' => $request['website'] ?? '-',
        ]); // menambah data

        return redirect('master-data/perusahaan')->with('success', 'Data berhasil diajukan!'); //langsung menuju halamn utamanya

    }

    public function update(Request $request, $id)
    {
         // Validasi data
         $validatedData = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
        ]);

        $user = Perusahaan::findOrFail($id); //mencari id yang sama pada database
        $user->update([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'kontak' => $validatedData['kontak'],
            'website' => $request['website'] ?? '-',
        ]); //update data perusahaan

        return redirect('master-data/perusahaan')->with('success', 'Data berhasil diupdate!'); //langsung menuju halamn utamanya
    }

    public function delete($id)
    {
        $perusahaan = Perusahaan::findOrFail($id); // Mengambil data berdasarkan ID
        $perusahaan->delete(); // Menghapus data

        return redirect('master-data/perusahaan')->with('success', 'perusahaan berhasil dihapus!'); //langsung menuju halamn utamanya
    }
}
