<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function index(){
        $data_draft = Surat::where('status','draft')->count();
        $data_reject = Surat::where('status','reject')->count();
        $data_accept = Surat::where('status','accept')->count();
        return view('dashboard',compact('data_draft','data_reject','data_accept'));
        // return view('dashboard',['data_draft' => $data_draft]);
    }
}
