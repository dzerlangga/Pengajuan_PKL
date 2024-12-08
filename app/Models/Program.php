<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'pengumuman','status', 'start_date', 'end_date'
    ];

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}
