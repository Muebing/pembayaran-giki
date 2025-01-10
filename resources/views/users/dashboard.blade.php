@extends('layout_siswa.master')
@section('content')
    <div class="row mt-4">
        <!-- Kolom Kiri untuk Profile Siswa dan Visi & Misi -->
        <div class="col-lg-7 mb-lg-0 mb-4 align-items-start">
            <!-- Card Profile Siswa -->
            <div class="card card-profile z-index-2 mb-4" style="max-height: 250px; overflow: auto;">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Profile Siswa</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto User" class="rounded-circle me-5"
                            width="140" height="150">
                        <div>
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-2">Status: <span
                                    class="badge bg-success">{{ Auth::user()->role }}</span></p>
                            <p class="mb-1"><i class="ni ni-mobile-button alt me-2"></i>{{ Auth::user()->no_telp }}</p>
                            <p class="mb-1"><i class="ni ni-email-83 me-2"></i>
                                {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Visi & Misi -->
            <div class="card card-vision-mission p-4 overflow-hidden" style="height: auto;">
                <div class="card-body">
                    <h5 class="card-title text-capitalize">Visi, Misi, dan Tujuan</h5>

                    <p class="card-text">
                        <strong>Visi Kami Adalah</strong>: “UNGGUL DALAM PRESTASI SEJALAN DENGAN IPTEK DAN
                        IMTAQ”
                    </p>

                    <p class="card-text"><strong>Misi Kami Adalah:</strong></p>
                    <ol>
                        <li>Memotivasi siswa untuk memahami potensi diri</li>
                        <li>Mengembangkan potensi siswa secara optimal sesuai dengan perkembangan IPTEK</li>
                        <li>Meningkatkan IMTAQ </li>
                        <li>Meningkatkan profesional guru </li>
                        <li>Bekerjasama dengan berbagai lembaga pendidikan dalam rangka meningkatkan mutu
                            pendidikan</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Bagian Baru untuk Carousel Berita -->
        <!-- Kontainer untuk Berita Terbaru -->
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-body text-center">
                    <h4 class="mb-0" style="font-weight: bold; color:black">BERITA SMA GITA KIRTI 2
                    </h4>
                </div>
            </div>
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide Berita 1 -->
                    <div class="carousel-item active">
                        <div class="card">
                            <img src="../assets/img/hari-guru-nasional.png" class="card-img-top" alt="Gambar Berita 1">
                            <div class="card-body">
                                <h5 class="card-title">Hari Guru Nasional 2023</h5>
                                <p class="card-text"><small class="text-muted">26 November 2024 | Hari Guru
                                        Nasional</small></p>
                                <p class="card-text">Hari Guru Nasional (HGN) setiap tahunnya diperingati pada
                                    tanggal 25 November. Peringatan HGN juga menjadi ruang apresiasi yang
                                    diberikan kepada para guru atas semangat belajar, berbagi, dan berkolaborasi
                                    dalam merdeka belajar demi terwujudnya pembelajaran yang aman, nyaman, dan
                                    menyenangkan bagi peserta didik.

                                    Tema peringatan HGN tahun 2023 adalah “Bergerak Bersama, Rayakan Merdeka
                                    Belajar”. Masyarakat dapat menyaksikan siaran langsung puncak peringatan
                                    Hari Guru Nasional 2023 di kanal YouTube KEMENDIKBUD RI dan Indonesiana TV
                                    pada Sabtu, 25 November 2023, pukul 15.00 WIB s.d. selesai.

                                    “Mari bersama kita berikan apresiasi dan penghargaan kepada para guru-guru
                                    Indonesia yang selalu belajar, berbagi, dan berkolaborasi dengan semangat
                                    Merdeka Belajar, serta telah berjuang untuk menciptakan pembelajaran yang
                                    aman, nyaman, dan menyenangkan bagi murid,” tutur Direktur Jenderal Guru dan
                                    Tenaga Kependidikan (Dirjen GTK), Nunuk Suryani, di Jakarta, Jumat (24/11).


                                    SMA Gita Kirtti 2 Jakarta mengucapkan Selamat Hari Guru Nasional 2023,
                                    semoga semua pelajar bisa lebih bersemangat dan membantu peserta didik
                                    meraih impian dan cita-cita di masa depan kelak!</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide Berita 2 -->
                    <div class="carousel-item">
                        <div class="card">
                            <img src="../assets/img/hari-pahlawan-nasional.png" class="card-img-top" alt="Gambar Berita 2">
                            <div class="card-body">
                                <h5 class="card-title">Memperingati Hari Pahlawan Nasional 2023</h5>
                                <p class="card-text"><small class="text-muted">10 November 2023 | Hari
                                        Pahlawan</small></p>
                                <p class="card-text">Selamat Hari Pahlawan Nasional 10 November 2023,
                                    Semangat pahlawan untuk masa depan bangsa dalam memerangi kemiskinan dan
                                    kebodohan!
                                    Seyogianya masyarakat indonesia juga harus memiliki semangat kepahlawanan
                                    dan tergerak hatinya untuk membangun negeri sesuai potensi dan profesi
                                    masing-masing ✊</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide Berita 3 -->
                    <div class="carousel-item">
                        <div class="card">
                            <img src="../assets/img/maulid-nabi.png" class="card-img-top" alt="Gambar Berita 3">
                            <div class="card-body">
                                <h5 class="card-title">Maulid Nabi Muhammad SAW 2023</h5>
                                <p class="card-text"><small class="text-muted">05 October 2023 | Maulid
                                        Nabi</small></p>
                                <p class="card-text">Kami keluarga besar SMA Gita Kirtti 2 Jakarta mengucapkan
                                    "Selamat memperingati Maulid Nabi Muhammad SAW 2023". Semoga damai selalu
                                    menyertai kita semua. Selamat Maulid Nabi Muhammad SAW, 12 Rabiul Awal
                                    merupakan hari kelahiran sang suri tauladan mampu menyinari kegelapan umat.
                                    Semesta ini berseri penuh suka cita dan bahagia menyambut Maulid Nabi
                                    Muhammad SAW.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Navigasi Carousel Berita -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection
