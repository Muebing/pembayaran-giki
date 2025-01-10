@extends('layout_kepsek.master')

@section('content')
    <style>
        .table-custom th {
            background-color: #f8f9fa;
            color: #333;
            border: 2px solid #dee2e6;
        }

        .table-custom td {
            border: 2px solid #dee2e6;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f5f8;
        }

        .rounded-circle {
            object-fit: cover;
        }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4">Data Siswa SMA GITA KIRTI 2 JAKARTA</h2>
        </div>

        <!-- Dropdown untuk memilih kelas -->
        <div class="mb-4">
            <label for="kelas" class="form-label fw-bold">Pilih Kelas</label>
            <select id="kelas" class="form-select">
                <option value="">Semua Kelas</option>
                @foreach ($kelasOptions as $kelas)
                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tabel untuk menampilkan data siswa -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle text-center table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">Foto</th>
                        <th style="width: 15%;">Nama</th>
                        <th style="width: 10%;">NISN</th>
                        <th style="width: 20%;">Alamat</th>
                        <th style="width: 10%;">Kelas</th>
                        <th style="width: 10%;">Jenis Kelamin</th>
                        <th style="width: 10%;">Agama</th>
                        <th style="width: 10%;">Tempat Lahir</th>
                        <th style="width: 15%;">Tanggal Lahir</th>
                        <th style="width: 10%;">No Telepon</th>
                    </tr>
                </thead>
                <tbody id="siswaTableBody">
                    @forelse ($dataSiswa as $siswa)
                        <tr class="siswa-row" data-kelas="{{ $siswa->kelas }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->name }}"
                                    class="rounded-circle" style="width: 50px; height: 50px;">
                            </td>
                            <td class="text-capitalize">{{ $siswa->name }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->alamat }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ ucfirst($siswa->jenis_kelamin) }}</td>
                            <td>{{ ucfirst($siswa->agama) }}</td>
                            <td>{{ ucfirst($siswa->tempat_lahir) }}</td>
                            <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $siswa->no_telp }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-muted">Tidak ada data siswa tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // JavaScript untuk menyaring siswa berdasarkan kelas
        document.getElementById('kelas').addEventListener('change', function() {
            const selectedKelas = this.value;
            const siswaRows = document.querySelectorAll('.siswa-row');

            siswaRows.forEach(row => {
                if (selectedKelas === "" || row.getAttribute('data-kelas') === selectedKelas) {
                    row.style.display = ''; // tampilkan baris
                } else {
                    row.style.display = 'none'; // sembunyikan baris
                }
            });
        });
    </script>
@endsection
