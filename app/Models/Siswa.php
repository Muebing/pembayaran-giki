<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nama',
        'nisn',
        'alamat',
        'kelas',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'foto',
        'created_at',
        'updated_at'
    ];
}
