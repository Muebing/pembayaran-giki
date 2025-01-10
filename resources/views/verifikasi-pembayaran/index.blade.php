@extends('layout_admin.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="fw-bold">Verifikasi Pembayaran</h2>
        </div>


        <!-- Session Alerts -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <!-- Form Pencarian -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('verif.pembayaran.index') }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="search" class="form-label">Cari Nama Siswa</label>
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ request('search') }}" placeholder="Masukkan Nama Siswa">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="verifikasi" class="form-label">Filter Status Verifikasi</label>
                            <select name="verifikasi" id="verifikasi" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                <option value="1" {{ request('verifikasi') == '1' ? 'selected' : '' }}>Sudah
                                    Diverifikasi
                                </option>
                                <option value="0" {{ request('verifikasi') == '0' ? 'selected' : '' }}>Belum
                                    Diverifikasi
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Data Pembayaran -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nominal</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                <th>Persetujuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftar as $key => $pembayaran)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $pembayaran['nama_siswa'] }}</td>
                                    <td>{{ $pembayaran['jenis_pembayaran'] }}</td>
                                    <td class="text-end">Rp {{ number_format($pembayaran['nominal'], 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $pembayaran['tenggat_waktu'] }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $pembayaran['status'] == 'lunas' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($pembayaran['status']) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $pembayaran['verifikasi'] == 1 ? 'bg-success' : 'bg-warning' }}">
                                            {{ $pembayaran['verifikasi'] == 1 ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Lihat -->
                                            <a href="{{ route('verif.pembayaran.show', $pembayaran['id']) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>

                                            @if ($pembayaran['verifikasi'] == 0)
                                                <!-- Tombol Verifikasi -->
                                                <form id="verifyForm{{ $pembayaran['id'] }}"
                                                    action="{{ route('verif.pembayaran.verify', $pembayaran['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        onclick="return confirmVerify(event, {{ $pembayaran['id'] }})"
                                                        data-bs-toggle="tooltip" title="Verifikasi">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>

                                                <!-- Tombol Tolak -->
                                                <form id="rejectForm{{ $pembayaran['id'] }}"
                                                    action="{{ route('verif.pembayaran.reject', $pembayaran['id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirmReject(event, {{ $pembayaran['id'] }})">
                                                        <i class="fas fa-times-circle"></i> Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-primary btn-sm" disabled>
                                                    <i class="fas fa-check-circle"></i> Verifikasi
                                                </button>
                                                <button class="btn btn-danger btn-sm" disabled>
                                                    <i class="fas fa-times-circle"></i> Tolak
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pembayaran untuk diverifikasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $daftar->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript untuk Konfirmasi -->
        <script>
            function confirmVerify(event, id) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan memverifikasi pembayaran ini!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Verifikasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('verifyForm' + id).submit();
                    }
                });
            }

            function confirmReject(event, id) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan menolak pembayaran ini!',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('rejectForm' + id).submit();
                    }
                });
            }
        </script>
    </div>
@endsection
