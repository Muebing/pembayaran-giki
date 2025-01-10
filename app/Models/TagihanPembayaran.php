<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanPembayaran extends Model
{
    protected $table = 'tagihan_pembayarans';
    protected $fillable = ['siswa_id', 'jenis_pembayaran_id', 'status', 'tanggal_pembayaran', 'bukti_bayar', 'verifikasi'];


    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
