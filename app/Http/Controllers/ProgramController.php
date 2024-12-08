<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use Carbon\Carbon;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $data = Program::where('nama', 'like', "%{$search}%");

        if ($request->ajax()) {
            return view('program.table', ['datas'=>$data->orderBy('created_at', 'desc')->paginate(5)])->render();
        }

        return view('program.index',['datas'=>$data->paginate(5)]);
    }

    public function addForm(){
        return view('program.form');
    }

    public function editForm($id){
        $data = Program::where('id',$id)->first();
        return view('program.form',['data'=>$data]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pengumuman' => 'required|string',
        ]);

        // 1. Simpan data program
        Program::create([
            'nama' => $validatedData['nama'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'pengumuman' => $validatedData['pengumuman'],
            'status' => '0',
        ]);

        return redirect('master-data/program')->with('success', 'Data berhasil diajukan!');

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pengumuman' => 'required|string',
        ]);

        $user = Program::findOrFail($id);
        $user->update([
            'nama' => $validatedData['nama'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'pengumuman' => $validatedData['pengumuman'],
        ]);

        return redirect('master-data/program')->with('success', 'Data berhasil diupdate!');
    }

    public function updateStatus(Request $request,$id) {

        $data = Program::where('status',1)->first();


        if ($data && $data->id != $id) {
            return response()->json(['message' => 'Data masih ada yang aktif','statusCode'=> 400, 'status'=>'warning']);
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        // Temukan order berdasarkan ID dan update statusnya
        $order = Program::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Status berhasil diperbarui','statusCode'=> 200, 'status'=>'success']);

    }

    public function delete($id)
    {
        $program = Program::findOrFail($id); // Mengambil data berdasarkan ID
        $program->delete(); // Menghapus data

        return redirect('master-data/program')->with('success', 'program berhasil dihapus!');
    }
}
