<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function exportPdf($id)
    {
        Carbon::setLocale('id'); //menyetel jam bagian negara indonesia
        $now = Carbon::now()->translatedFormat('d F Y'); //untuk memformat tanggal
        $data_surat = Surat::with(['jurusan', 'anggota', 'program'])->where('id',$id)->first();
        $data = ['now' => $now, 'data_surat'=>$data_surat]; //membuat variabel untuk di tampilkan ke view
        $pdf = Pdf::loadView('plugin.pdf.template', $data); //load view yang aka di jadikan pdf
        return $pdf->download('contoh-laporan.pdf'); //action download
    }
}
