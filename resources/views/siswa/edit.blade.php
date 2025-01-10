@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h2>Edit Data Siswa</h2>
        <form id="edit-form" action="{{ route('siswas.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name', $siswa->name) }}" required>
            </div>

            <!-- NISN -->
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" id="nisn"
                    value="{{ old('nisn', $siswa->nisn) }}" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>

            <!-- Kelas -->
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" id="kelas"
                    value="{{ old('kelas', $siswa->kelas) }}" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" id="jenis_kelamin" required>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <!-- Agama -->
            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select name="agama" class="form-select" id="agama" required>
                    <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                    </option>
                    <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                    </option>
                    <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu
                    </option>
                </select>
            </div>

            <!-- Tempat Lahir -->
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                    value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" required>
            </div>

            <!-- No Telepon -->
            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="text" name="no_telp" class="form-control" id="no_telp"
                    value="{{ old('no_telp', $siswa->no_telp) }}" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" id="foto">
                @if ($siswa->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="rounded-circle"
                            width="140" height="150">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="button" id="update-button" class="btn btn-primary">Update</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('update-button').addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan semua data sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form setelah konfirmasi
                        document.getElementById('edit-form').submit();
                    }
                })
            });
        </script>
    </div>
@endsection
