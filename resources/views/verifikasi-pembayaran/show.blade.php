@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h2>Detail Pembayaran</h2>

        <table class="table">
            <tr>
                <th>Nama Siswa</th>
                <td>{{ $pembayaran->siswa->name }}</td>
            </tr>
            <tr>
                <th>Jenis Pembayaran</th>
                <td>{{ $pembayaran->jenisPembayaran->nama_pembayaran }}</td>
            </tr>
            <tr>
                <th>Nominal</th>
                <td>Rp {{ number_format($pembayaran->jenisPembayaran->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tanggal Bayar</th>
                <td>{{ $pembayaran->tanggal_pembayaran }}</td>
            </tr>
            <tr>
                <th>Status Persetujuan</th>
                <td>
                    <!-- Menampilkan status verifikasi -->
                    <span class="badge {{ $pembayaran['verifikasi'] == 1 ? 'bg-success' : 'bg-warning' }}">
                        {{ $pembayaran['verifikasi'] == 1 ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Bukti Pembayaran</th>
                <td>
                    <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" alt="Bukti Pembayaran" class="img-fluid"
                        style="max-width: 300px;">
                </td>
            </tr>
        </table>

        <a href="{{ route('verif.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>


    </div>
@endsection
