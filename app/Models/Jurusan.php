<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{

    use HasFactory;
    protected $fillable = [
        'nama','singkatan', 'created_at'
    ];

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}
