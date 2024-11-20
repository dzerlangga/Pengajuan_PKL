<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $data = Informasi::query();

        // filter by nama
        $data->when($request->nama, function ($query) use ($request) {
            return $query->where('nama','like', '%'.$request->nama.'%');
        });

        return view('informasi.index',['informasi'=>$data->get()]);
    }

    public function addForm(){
        return view('informasi.form');
    }

    public function editForm($id){
        $data = Informasi::where('id',$id)->first();
        return view('informasi.form',['data'=>$data]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'pengumuman' => 'required|string',
        ]);


        // 1. Simpan data informasi
        Informasi::create([
            'nama' => $validatedData['nama'],
            'pengumuman' => $validatedData['pengumuman'],
            'status' => '0',
        ]);

        return redirect('master-data/informasi')->with('success', 'Data berhasil diajukan!');

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'pengumuman' => 'required|string',
        ]);

        $user = Informasi::findOrFail($id);
        $user->update([
            'nama' => $validatedData['nama'],
            'pengumuman' => $validatedData['pengumuman'],
        ]);

        return redirect('master-data/informasi')->with('success', 'Data berhasil diupdate!');
    }

    public function updateStatus(Request $request,$id) {

        $data = Informasi::where('status',1)->first();


        if ($data && $data->id != $id) {
            return response()->json(['message' => 'Data masih ada yang aktif','statusCode'=> 400, 'status'=>'warning']);
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        // Temukan order berdasarkan ID dan update statusnya
        $order = Informasi::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Status berhasil diperbarui','statusCode'=> 200, 'status'=>'success']);

    }

    public function delete($id)
    {
        $informasi = Informasi::findOrFail($id); // Mengambil data berdasarkan ID
        $informasi->delete(); // Menghapus data

        return redirect('master-data/informasi')->with('success', 'informasi berhasil dihapus!');
    }
}
