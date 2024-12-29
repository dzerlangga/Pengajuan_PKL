<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $fillable = ['alamat', 'jurusan_id', 'program_id', 'perusahaan', 'no_hp','status', 'created_at'];

    public function anggota()
    {
        return $this->hasMany(AnggotaPengajuan::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }
}
