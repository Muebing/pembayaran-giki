@extends('layout_kepsek.master')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4">Laporan Pembayaran Siswa</h2>

        <!-- Rekapitulasi Pembayaran -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Rekapitulasi Pembayaran</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Total Pembayaran</th>
                        <td>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Siswa Membayar</th>
                        <td>{{ $jumlahSiswaMembayar }} Siswa</td>
                    </tr>
                    <tr>
                        <th>Jumlah Siswa Tunggakan</th>
                        <td>{{ $jumlahSiswaTunggakan }} Siswa</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Laporan Bulanan -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Laporan Bulanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('riwayat-laporan') }}" method="GET" class="mb-4">
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
                            <option value="">Pilih Bulan</option>
                            @foreach ([
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ] as $key => $month)
                                <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th>Bulan</th>
                            <th>Total Pembayaran</th>
                            <th>Tunggakan</th>
                            <th>Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanBulanan as $laporan)
                            <tr>
                                <td>{{ DateTime::createFromFormat('!m', $laporan->bulan)->format('F') }}</td>
                                <td>Rp {{ number_format($laporan->total_pembayaran, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($laporan->tunggakan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($laporan->selesai, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data pembayaran di bulan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
