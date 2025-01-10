@extends('layout_siswa.master')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Informasi Tagihan Pembayaran</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-2">
                    <!-- Informasi Siswa -->
                    <div class="mb-3">
                        <strong>Nama Siswa: </strong> {{ Auth::user()->name }}
                    </div>
                    <!-- Tabel Detail Tagihan -->
                    <div class="section-header">Detail Tagihan Pembayaran</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Tagihan</th>
                                <th>Jumlah</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($filteredJenisPembayarans as $jenisPembayaran)
                                @php
                                    $tagihan = $tagihans->firstWhere('jenis_pembayaran_id', $jenisPembayaran->id);
                                    $status = $tagihan ? ucfirst($tagihan->status) : 'Belum Lunas';
                                @endphp
                                <tr>
                                    <td>{{ $jenisPembayaran->nama_pembayaran }}</td>
                                    <td>Rp {{ number_format($jenisPembayaran->nominal, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($jenisPembayaran->metode_pembayaran) }}</td>
                                    <td>
                                        @if ($tagihan)
                                            @if ($tagihan->status === 'lunas')
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif ($tagihan->status === 'menunggu_konfirmasi')
                                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                            @else
                                                <span class="badge bg-danger">Belum Lunas</span>
                                            @endif
                                        @else
                                            <span class="badge bg-danger">Belum Lunas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada tagihan pembayaran yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Form Pembayaran Virtual Account -->
                    <div class="section-header mt-4">Pembayaran Virtual Account</div>
                    @if ($tagihans->where('status', 'menunggu_konfirmasi')->isEmpty())
                        <form action="{{ route('tagihan_pembayaran.storeMultiple') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Pilih Tagihan yang Akan Dibayar:</label>
                                @foreach ($filteredJenisPembayarans as $jenisPembayaran)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_pembayaran_ids[]"
                                            value="{{ $jenisPembayaran->id }}" id="jenis_{{ $jenisPembayaran->id }}"
                                            data-nominal="{{ $jenisPembayaran->nominal }}"
                                            data-va="{{ $jenisPembayaran->virtual_account }}">
                                        <label class="form-check-label" for="jenis_{{ $jenisPembayaran->id }}">
                                            {{ $jenisPembayaran->nama_pembayaran }}
                                            (Rp {{ number_format($jenisPembayaran->nominal, 0, ',', '.') }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="alert alert-info">
                                <strong>Nominal:</strong> <span id="nominal">-</span><br>
                                <strong>Nomor Virtual Account:</strong> <span id="vaNumber">-</span><br>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran"
                                    required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="bukti_bayar">Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Bayar</button>
                        </form>
                    @else
                        <p>Salah satu tagihan Anda sedang menunggu konfirmasi, Anda tidak dapat memilih tagihan untuk
                            dibayar saat ini.
                        </p>
                    @endif
                </div>
            </div>
            <script>
                // Menghitung total nominal dan nomor virtual account
                document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        let totalNominal = 0;
                        let vaNumbers = [];
                        document.querySelectorAll('.form-check-input:checked').forEach(function(checkedBox) {
                            totalNominal += parseFloat(checkedBox.getAttribute('data-nominal'));
                            // Ambil hanya nomor virtual account dari tagihan pertama yang dipilih
                            if (vaNumbers.length === 0) {
                                vaNumbers.push(checkedBox.getAttribute('data-va'));
                            }
                        });
                        // Menampilkan total nominal dan nomor virtual account
                        document.getElementById('nominal').textContent = `Rp ${totalNominal.toLocaleString()}`;
                        document.getElementById('vaNumber').textContent = vaNumbers.join(', ') || '-';
                    });
                });
            </script>
            <script>
                // Menampilkan SweetAlert2 jika ada session success
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'Tutup'
                    });
                @endif
                // Menampilkan SweetAlert2 jika ada session error
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: '{{ session('error') }}',
                        confirmButtonText: 'Tutup'
                    });
                @endif
            </script>
        </div>
    </div>
@endsection
