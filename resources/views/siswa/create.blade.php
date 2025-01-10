@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h2>Tambah Data Siswa</h2>
        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>

            <!-- NISN -->
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" id="nisn" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" required></textarea>
            </div>

            <!-- Kelas -->
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" class="form-select" id="kelas" required>
                    <option value="">Pilih Kelas</option>
                    <option value="10">X</option>
                    <option value="11">XI</option>
                    <option value="12">XII</option>
                </select>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" id="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Agama -->
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" class="form-select" id="agama" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <!-- Tempat Lahir -->
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
            </div>

            <!-- No Telepon -->
            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
