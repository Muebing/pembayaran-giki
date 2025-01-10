@extends('layout_admin.master')


@section('content')
    <div class="container">
        <h2>Verifikasi Pembayaran</h2>

        <div class="card">
            <div class="card-header">
                Verifikasi Pembayaran untuk Siswa: {{ $daftar['nama_siswa'] }}
            </div>
            <div class="card-body">
                <p><strong>Jenis Pembayaran:</strong> {{ $daftar['jenis_pembayaran'] }}</p>
                <p><strong>Nominal:</strong> Rp {{ number_format($daftar['nominal'], 0, ',', '.') }}</p>
                <p><strong>Tenggat Waktu:</strong> {{ $daftar['tenggat_waktu'] }}</p>
                <p><strong>Status:</strong> <span class="badge bg-warning">{{ $daftar['status'] }}</span></p>

                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Verifikasi Pembayaran</button>
                    <a href="{{ route('verif.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
