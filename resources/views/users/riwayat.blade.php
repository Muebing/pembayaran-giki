@extends('layout_siswa.master')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4">
                <!-- Header Card -->
                <div class="card-header pb-0">
                    <h6>Riwayat Pembayaran</h6>
                </div>

                <!-- Body Card -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <!-- Informasi Siswa -->
                        <div class="mb-4">
                            <strong>Nama Siswa:</strong> {{ Auth::user()->name }}
                        </div>

                        <!-- Tabel Riwayat Pembayaran -->
                        <table class="table table-striped table-hover align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Tagihan</th>
                                    <th>Status</th>
                                    <th class="text-end">Nominal</th>
                                    <th class="text-center">Tanggal Pembayaran</th>
                                    <th class="text-center">Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tagihans as $tagihan)
                                    <tr>
                                        <td>{{ $tagihan->jenisPembayaran->nama_pembayaran }}</td>
                                        <td>{{ ucfirst($tagihan->status) }}</td>
                                        <td class="text-end">Rp
                                            {{ number_format($tagihan->jenisPembayaran->nominal, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            {{ $tagihan->tanggal_pembayaran ? \Carbon\Carbon::parse($tagihan->tanggal_pembayaran)->format('Y-m-d') : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('riwayat-pembayaran.pdf', $tagihan->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Cetak PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data pembayaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Tombol Cetak Semua -->
                        <div class="mt-3">
                            <a href="{{ route('riwayat-pembayaran.all.pdf') }}" class="btn btn-success">
                                Cetak Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
