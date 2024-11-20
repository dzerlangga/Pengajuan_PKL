<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPengajuan extends Model
{

    use HasFactory;
    protected $fillable = ['surat_id', 'nama', 'nis'];

    public function pengajuanSurat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function anggotaList()
    {
        return $this->hasMany(Surat::class);
    }
}
