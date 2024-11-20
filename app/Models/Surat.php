<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{

    use HasFactory;
    protected $fillable = ['alamat', 'jurusan_id', 'perusahaan', 'no_hp','status'];

    public function anggota()
    {
        return $this->hasMany(AnggotaPengajuan::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
