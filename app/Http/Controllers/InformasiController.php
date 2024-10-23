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

        return view('pengumuman.index',['informasi'=>$data->get()]);
    }
}
