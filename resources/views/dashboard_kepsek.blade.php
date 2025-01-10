@extends('layout_kepsek.master')

@section('content')
    <div class="row">
        <!-- Card Profile Siswa -->
        <div class="col-xl-6 col-sm-12 mb-4">
            <div class="card card-profile z-index-2 mb-2"
                style="max-height: 200px; overflow: auto; width: 350px; margin-top: 20px;">
                <div class="card-body pt-3 p-2 d-flex align-items-center">
                    <!-- Foto -->
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto User" class="rounded-circle me-3 border"
                        style="width: 80px; height: 80px; object-fit: cover;">
                    <!-- Info -->
                    <div>
                        <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-1">
                            Status: <span class="badge bg-success">{{ Auth::user()->role }}</span>
                        </p>
                        <p class="small mb-0">
                            <i class="ni ni-email-83 me-1"></i>{{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3>Dashboard Kepala Sekolah</h3>

        <!-- Ringkasan Pembayaran -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Pembayaran</h5>
                        <p class="card-text">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa Membayar</h5>
                        <p class="card-text">{{ $jumlahSiswaMembayar }} Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa Belum Membayar</h5>
                        <p class="card-text">{{ $jumlahSiswaTunggakan }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Pembayaran -->
        <form method="GET" action="{{ route('dashboard_kepsek') }}">
            <div class="row mb-4">
                <!-- Pilih Tahun -->
                <div class="col-md-4">
                    <label for="tahun" class="form-label">Pilih Tahun</label>
                    <select name="tahun" id="tahun" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih Tahun</option>
                        @foreach (range(date('Y'), date('Y') - 10) as $tahun)
                            {{-- 10 tahun terakhir --}}
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Bulan -->
                <div class="col-md-4">
                    <label for="bulan" class="form-label">Pilih Bulan</label>
                    <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih Bulan</option>
                        <option value="1" {{ request('bulan') == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ request('bulan') == 2 ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ request('bulan') == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ request('bulan') == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ request('bulan') == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ request('bulan') == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ request('bulan') == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ request('bulan') == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ request('bulan') == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('bulan') == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('bulan') == 11 ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('bulan') == 12 ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                <!-- Pilih Jenis Pembayaran -->
                <div class="col-md-4">
                    <label for="jenis_pembayaran" class="form-label">Pilih Jenis Pembayaran</label>
                    <select id="jenis_pembayaran" class="form-select" onchange="filterChart()">
                        <option value="all">Semua Pembayaran</option>
                        @foreach ($jenisPembayaranList as $index)
                            <option value="{{ $index }}">{{ $index }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Grafik Pembayaran -->
        <div class="mt-5">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Total Pembayaran Terverifikasi</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">
                                Tahun: {{ request('tahun') ?? 'Semua Tahun' }}, Bulan:
                                {{ request('bulan') ? ucfirst(DateTime::createFromFormat('!m', request('bulan'))->format('F')) : 'Semua Bulan' }}
                            </span>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                        <div id="nama-pembayaran-detail" style="margin-top: 20px; font-size: 16px; font-weight: bold;">
                            Klik salah satu bar untuk melihat nama pembayaran.
                        </div>
                        <script>
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const bulanLabels = @json($bulanLabels);
                            const jumlahPembayaranPerBulan = @json($jumlahPembayaranPerBulan);
                            const jenisPembayaranLabels = @json($jenisPembayaranLabels);

                            let filteredData = jumlahPembayaranPerBulan;

                            const myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: bulanLabels,
                                    datasets: [{
                                        label: 'Jumlah Pembayaran',
                                        data: jumlahPembayaranPerBulan,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)',
                                            'rgba(100, 181, 246, 0.2)',
                                            'rgba(174, 213, 129, 0.2)',
                                            'rgba(255, 183, 77, 0.2)',
                                            'rgba(121, 134, 203, 0.2)',
                                            'rgba(230, 126, 34, 0.2)',
                                            'rgba(46, 204, 113, 0.2)',
                                            'rgba(241, 196, 15, 0.2)',
                                            'rgba(231, 76, 60, 0.2)',
                                            'rgba(52, 152, 219, 0.2)',
                                            'rgba(155, 89, 182, 0.2)',
                                            'rgba(192, 57, 43, 0.2)',
                                            'rgba(142, 68, 173, 0.2)',
                                            'rgba(39, 174, 96, 0.2)',
                                            'rgba(22, 160, 133, 0.2)',
                                            'rgba(127, 140, 141, 0.2)',
                                            'rgba(189, 195, 199, 0.2)',
                                            'rgba(52, 73, 94, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)',
                                            'rgb(100, 181, 246)',
                                            'rgb(174, 213, 129)',
                                            'rgb(255, 183, 77)',
                                            'rgb(121, 134, 203)',
                                            'rgb(230, 126, 34)',
                                            'rgb(46, 204, 113)',
                                            'rgb(241, 196, 15)',
                                            'rgb(231, 76, 60)',
                                            'rgb(52, 152, 219)',
                                            'rgb(155, 89, 182)',
                                            'rgb(192, 57, 43)',
                                            'rgb(142, 68, 173)',
                                            'rgb(39, 174, 96)',
                                            'rgb(22, 160, 133)',
                                            'rgb(127, 140, 141)',
                                            'rgb(189, 195, 199)',
                                            'rgb(52, 73, 94)',
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    onClick: (event, elements) => {
                                        if (elements.length > 0) {
                                            const index = elements[0].index;
                                            const namaPembayaran = jenisPembayaranLabels[index];
                                            const detailElement = document.getElementById('nama-pembayaran-detail');
                                            detailElement.innerText = `Pembayaran: ${namaPembayaran}`;
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            function filterChart() {
                                const selectedJenis = document.getElementById('jenis_pembayaran').value;

                                // Filter data sesuai jenis pembayaran
                                if (selectedJenis === "all") {
                                    filteredData = jumlahPembayaranPerBulan; // Semua data
                                } else {
                                    filteredData = jumlahPembayaranPerBulan.map((val, index) => {
                                        return jenisPembayaranLabels[index] === selectedJenis ? val : 0;
                                    });
                                }

                                // Update data di grafik
                                myChart.data.datasets[0].data = filteredData;
                                myChart.update();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
