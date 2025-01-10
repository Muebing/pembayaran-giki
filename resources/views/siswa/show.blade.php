@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h2>Detail Siswa</h2>
        <a href="{{ route('siswas.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Siswa</a>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $siswa->name }}</p>
                <p><strong>Nisn:</strong> {{ $siswa->nisn }}</p>
                <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</p>
                <p><strong>Agama:</strong> {{ $siswa->agama }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir }}</p>
                <p><strong>No Telepon:</strong> {{ $siswa->no_telp }}</p>
                <!-- Foto -->
                <p><strong>Foto:</strong></p>
                @if ($siswa->foto)
                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" width="150">
                @else
                    <p>Foto tidak tersedia</p>
                @endif
            </div>
        </div>
    </div>
@endsection
