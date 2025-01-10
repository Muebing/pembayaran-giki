<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    protected $table = 'jenis_pembayarans';
    protected $fillable = ['nama_pembayaran', 'nominal', 'metode_pembayaran', 'virtual_account'];

    public function tagihans()
    {
        return $this->hasMany(TagihanPembayaran::class, 'jenis_pembayaran_id');
    }
}
