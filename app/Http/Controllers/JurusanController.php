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

        return view('jurusan.index',['jurusan'=>$data->get()]);
    }
}
