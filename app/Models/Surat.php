<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{

    use HasFactory;
    protected $fillable = ['alamat', 'jurusan', 'perusahaan', 'no_hp'];

    public function anggota()
    {
        return $this->hasMany(AnggotaPengajuan::class);
    }
}
